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
    
    public function __construct(Client $client, ReleaseNews $releaseNews) {
        $this->client = $client;
        $this->releaseNews = $releaseNews;
    }

    /**
     * @param Command $command
     * @param int $success crawling success count
     * @param int $duplicate crawling duplicate count
     * @param int $fail crawling fail count
     * @see release data -> \App\ReleaseNews::SUPPORT_RELEASES
     */
    public function update(?Command $command = null, int $success = 0, int $duplicate = 0, int $fail = 0) {
        $datas = $this->releaseNews::getAllCrawlData();
        $this->print('릴리즈 크롤링 데이터 검색 건수: ' . count($datas));

        foreach ($datas as $type => $data) {
            try {
                DB::beginTransaction();
                
                $crawler = $this->crawler($data['site_url']);
                $version = $crawler->filter($data['version'])->text();

                if (isset($data['post'])) {
                    $crawler = $this->crawler($this->releaseInContent($data['post']['url'], $data['post']['before'], $data['post']['after'], $version));
                }

                $content = $crawler->filter($data['content'])->text();
                    
                if ($this->releaseNews::existTypeAndVersion($type, $this->releaseVersionCheck($version))) {
                    $duplicate++;
                    continue;
                }

                $this->releaseNews::create([
                    'site_url' => $data['site_url'],
                    'type' => $type,
                    'version' => $this->releaseVersionCheck($version),
                    'content' => $content
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
     * @return  string
     */
    private function crawler(string $url) {
        $response = $this->client->get($url);
        $contents = $response->getBody()->getContents();
        $crawler = new Crawler($contents);

        return $crawler;
    }

    /**
     * @param   string $type
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

    private function print(string $message) {
        if ($this->command) {
            $this->command->info($message);
        } else {
            dump($message);
        }
    }
}
