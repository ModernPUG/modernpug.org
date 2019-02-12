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
        $datas = $this->releaseNews::SUPPORT_RELEASES;
        $this->print('릴리즈 크롤링 데이터 검색 건수: ' . count($datas));

        foreach ($datas as $type => $data) {
            try {
                DB::beginTransaction();

                $crawler = $this->convertCrawlerFromUrl($data['site_url']);
                $version = $crawler->filter($data['version'])->text();
                $releasedAt = $this->releaseDateModify(trim($crawler->filter($data['date'])->text()));

                if (isset($data['post'])) {
                    $siteUrl = $this->releaseInContent($data['post']['url'],
                        $data['post']['before'],
                        $data['post']['after'],
                        $version);
                    $crawler = $this->convertCrawlerFromUrl($siteUrl);
                }

                $content = $crawler->filter($data['content'])->text();

                if ($this->releaseNews::existTypeAndVersion($type, $this->releaseVersionCheck($version))) {
                    $duplicate++;
                    continue;
                }

                $this->releaseNews::create([
                    'site_url' => isset($data['post']) ? $siteUrl : $data['site_url'],
                    'type' => $type,
                    'version' => $this->releaseVersionCheck($version),
                    'content' => $content,
                    'released_at' => $releasedAt,
                ]);
                $success++;

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
     * @return  string
     */
    private function releaseInContent(string $url, string $before, string $after, string $version) {
        return $url . strtolower(preg_replace($before, $after, trim($version)));
    }

    /**
     * @param   string $date
     * @return  string
     */
    private function releaseDateModify(string $date) {
        // TODO: CI 경우 릴리즈 날짜에 문자가 포함 되어있으므로 제외시켜야함.
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
