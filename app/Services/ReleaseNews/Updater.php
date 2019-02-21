<?php

namespace App\Services\ReleaseNews;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Log;
use DB;

use App\ReleaseNews;

class Updater {
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Command
     */
    protected $command;
    /**
     * @var ReleaseNews
     */
    protected $releaseNews;

    public function __construct(Client $client, ReleaseNews $releaseNews) {
        $this->client = $client;
        $this->releaseNews = $releaseNews;
    }

    /**
     * @param int $success crawling success count
     * @param int $duplicate crawling duplicate count
     * @param int $fail crawling fail count
     * @throws \Exception
     */
    public function update(int $success = 0, int $duplicate = 0, int $fail = 0) {
        $this->print('크롤링 시작');

        foreach ($this->releaseNews::SUPPORT_RELEASES as $type => $data) {
            try {
                DB::beginTransaction();

                $crawler = $this->convertCrawlerFromUrl($data['site_url']);

                $version = $crawler->filter($data['version'])->each(function ($content) {
                    return $content->text();
                });

                $releasedAt = $crawler->filter($data['date'])->each(function ($content) {
                    return $content->text();
                });

                $releaseArray = $this->mergeCrawlerResult($version, $releasedAt);

                foreach ($releaseArray as $release) {
                    if ($this->releaseNews::existTypeAndVersion($type, $this->releaseVersionCheck($release[0]))) {
                        $duplicate++;
                        continue;
                    }

                    $this->print($type . '=> ' . $release[0]);

                    if (isset($data['post']['url'])) {
                        $siteUrl = $this->releaseInContent($data['post']['url'],
                            $data['post']['before'],
                            $data['post']['after'],
                            $this->releaseVersionCheck($release[0]),
                            $data['post']['end']);
                    }

                    $this->releaseNews::create([
                        'site_url' => empty($data['post']['url']) ? $data['site_url'] : $siteUrl,
                        'type' => $type,
                        'version' => $this->releaseVersionCheck($release[0]),
                        'released_at' => $this->releaseDateModify($release[1]),
                    ]);

                    $success++;
                }

                DB::commit();
            } catch (\Exception $e) {
                $fail++;
                DB::rollBack();
                Log::debug($e);
            }
        }

        $this->print('성공 건수: ' . $success);
        $this->print('중복 건수: ' . $duplicate);
        $fail && $this->print('실패 건수: ' . $fail);
    }

    /**
     * @param   string $url
     * @return  Crawler
     */
    private function convertCrawlerFromUrl(string $url) {
        $response = $this->client->get($url);
        $contents = $response->getBody()->getContents();
        $crawler = new Crawler($contents);

        return $crawler;
    }

    /**
     * @param mixed ...$argv
     * @return array
     */
    private function mergeCrawlerResult(...$argv) {
        $result = [];
        foreach ($argv as $array) {
            foreach ($array as $index => $value) {
                $result[$index][] = $value;
            }
        }

        return $result;
    }

    /**
     * @param   string $version
     * @return  string
     */
    private function releaseVersionCheck(string $version) {
        return preg_replace('/[^0-9_.-]/', '', trim($version));
    }

    /**
     * @param   string $url
     * @param   string $before
     * @param   string $after
     * @param   string $version
     * @param string $end
     * @return  string
     */
    private function releaseInContent(string $url, string $before, string $after, string $version, string $end) {
        if (empty($before) && empty($after)) {
            return $url . $version . $end;
        } else {
            return $url . strtolower(preg_replace($before, $after, trim($version))) . $end;
        }
    }

    /**
     * @param   string $date
     * @return  string
     */
    private function releaseDateModify(string $date) {
        // TODO: CI 경우 릴리즈 날짜에 문자가 포함 되어있으므로 제외시켜야함.
        if (strpos($date, ':') !== false) {
            return date('y-m-d', strtotime(substr($date, strpos($date, ':') + 2)));
        }
        return date('y-m-d', strtotime($date));
    }

    private function print(string $message) {
        if ($this->command) {
            $this->command->info($message);
        } else {
            dump($message);
        }
    }
}
