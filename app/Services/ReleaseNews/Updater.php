<?php

namespace App\Services\ReleaseNews;

use App\Models\ReleaseNews;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class Updater
{
    const CRAWLING_LIMIT = 5;
    const CRAWLING_INITIALIZE = 0;

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Command
     */
    protected $command;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param  int  $count  each type crawling limit 5
     * @param  int  $success  crawling success count
     * @param  int  $duplicate  crawling duplicate count
     * @param  int  $fail  crawling fail count
     *
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(int $count = 0, int $success = 0, int $duplicate = 0, int $fail = 0)
    {
        $this->print('크롤링 시작');

        foreach (ReleaseNews::SUPPORT_RELEASES as $type => $data) {
            try {
                DB::beginTransaction();

                // github api
                if (strpos($data['site_url'], 'api') !== false) {
                    $datas = $this->requestGithubAPI($data['site_url']);
                    foreach ($datas as $value) {
                        if (ReleaseNews::existTypeAndVersion($type, $this->convertReleaseVersion($value['tag_name']))) {
                            break;
                        }

                        if ($count == self::CRAWLING_LIMIT) {
                            $count = self::CRAWLING_INITIALIZE;
                            break;
                        }

                        ReleaseNews::create([
                            'site_url' => $value['html_url'],
                            'type' => $type,
                            'version' => $this->convertReleaseVersion($value['tag_name']),
                            'released_at' => Carbon::parse($value['published_at'])->format('Y-m-d'),
                        ]);

                        $success++;
                        $count++;
                    }
                } else {
                    $crawler = $this->convertCrawlerFromUrl($data['site_url']);

                    $version = $crawler->filter($data['version'])->each(function ($content) {
                        return $content->text();
                    });

                    $releasedAt = $crawler->filter($data['date'])->each(function ($content) {
                        return $content->text();
                    });

                    $releases = $this->mergeCrawlerResult($version, $releasedAt);

                    foreach ($releases as $release) {
                        if (ReleaseNews::existTypeAndVersion($type, $this->convertReleaseVersion($release[0]))) {
                            break;
                        }

                        if ($count == self::CRAWLING_LIMIT) {
                            $count = self::CRAWLING_INITIALIZE;
                            break;
                        }

                        $siteUrl = $this->releaseInContent($data['post']['url'],
                            $data['post']['before'],
                            $data['post']['after'],
                            $release[0],
                            $data['post']['end']);

                        ReleaseNews::create([
                            'site_url' => $siteUrl,
                            'type' => $type,
                            'version' => $this->convertReleaseVersion($release[0]),
                            'released_at' => $this->modifyReleaseDate($release[1]),
                        ]);

                        $success++;
                        $count++;
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                $fail++;
                DB::rollBack();
                Log::debug($e);
            }
        }

        $this->print('성공 건수: '.$success);
        $fail && $this->print('실패 건수: '.$fail);
    }

    /**
     * @param  string  $url
     * @return Crawler
     */
    private function convertCrawlerFromUrl(string $url)
    {
        $response = $this->client->get($url);
        $contents = $response->getBody()->getContents();
        $crawler = new Crawler($contents);

        return $crawler;
    }

    /**
     * @param  string  $url
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function requestGithubAPI(string $url)
    {
        $request = $this->client->request('GET', $url);

        return json_decode($request->getBody(), true);
    }

    /**
     * @param  mixed  ...$argv
     * @return array
     */
    private function mergeCrawlerResult(...$argv)
    {
        $result = [];
        foreach ($argv as $array) {
            foreach ($array as $index => $value) {
                $result[$index][] = $value;
            }
        }

        return $result;
    }

    /**
     * @param  string  $version
     * @return string
     */
    private function convertReleaseVersion(string $version)
    {
        $custom = count(explode(' ', trim($version))) >= 3 ? true : false;

        if ($custom) {
            if (strpos($version, 'released') !== false) {
                $version = preg_replace('/[^0-9_.-]/', '', trim($version));
            } else {
                $version = trim($version);
            }
        } else {
            if (strpos($version, 'released') !== false) {
                $version = preg_replace('/[^0-9_.-]/', '', trim($version));
            } else {
                $version = preg_replace('/^[a-zA-Z]+/', '', trim($version));
            }
        }

        return preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', trim($version));
    }

    /**
     * @param  string  $url
     * @param  string  $before
     * @param  string  $after
     * @param  string  $version
     * @param  string  $end
     * @return string
     */
    private function releaseInContent(string $url, string $before, string $after, string $version, string $end)
    {
        $custom = count(explode(' ', trim($version))) >= 3 ? true : false;

        if (! $custom) {
            $version = $this->convertReleaseVersion($version);
        }

        if (empty($before) && empty($after)) {
            return $url.$version.$end;
        } else {
            return $url.strtolower(preg_replace($before, $after, trim($version))).$end;
        }
    }

    /**
     * @param  string  $date
     * @return string
     */
    private function modifyReleaseDate(string $date)
    {
        if (strpos($date, ':') !== false) {
            return Carbon::parse(substr($date, strpos(trim($date), ':') + 2))->format('Y-m-d');
        }

        return Carbon::parse(trim($date))->format('Y-m-d');
    }

    private function print(string $message)
    {
        if ($this->command) {
            $this->command->info($message);
        } else {
            dump($message);
        }
    }
}
