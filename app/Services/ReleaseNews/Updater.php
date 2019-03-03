<?php

namespace App\Services\ReleaseNews;

use App\ReleaseNews;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class Updater {
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

    public function __construct(Client $client) {
        $this->client = $client;
    }

    /**
     * @param int $count each type crawling limit 5
     * @param int $success crawling success count
     * @param int $duplicate crawling duplicate count
     * @param int $fail crawling fail count
     * @throws \Exception
     */
    public function update(int $count = 0, int $success = 0, int $duplicate = 0, int $fail = 0) {
        $this->print('크롤링 시작');

        foreach (ReleaseNews::SUPPORT_RELEASES as $type => $data) {
            try {
                DB::beginTransaction();

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
                        $duplicate++;
                        $count++;
                        continue;
                    }

                    if ($count == self::CRAWLING_LIMIT) {
                        $count = self::CRAWLING_INITIALIZE;
                        $this->print('============> change crawling type');
                        break;
                    }

                    $this->print($type . '=> ' . trim($release[0]));

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
    private function convertReleaseVersion(string $version) {
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
     * @param   string $url
     * @param   string $before
     * @param   string $after
     * @param   string $version
     * @param   string $end
     * @return  string
     */
    private function releaseInContent(string $url, string $before, string $after, string $version, string $end) {
        $custom = count(explode(' ', trim($version))) >= 3 ? true : false;

        if (! $custom) {
            $version = $this->convertReleaseVersion($version);
        }

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
    private function modifyReleaseDate(string $date) {
        if (strpos($date, ':') !== false) {
            return date('y-m-d', strtotime(substr($date, strpos(trim($date), ':') + 2)));
        }
        return date('y-m-d', strtotime(trim($date)));
    }

    private function print(string $message) {
        if ($this->command) {
            $this->command->info($message);
        } else {
            dump($message);
        }
    }
}
