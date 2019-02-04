<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Log;
use DB;

use App\Release;

class ReleaseService {
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Command
     */
    protected $command;
    
    public function __construct(Client $client, Release $release) {
        $this->client = $client;
        $this->release = $release;
    }

    public function index() {

    }

    /**
     * @param Command $command
     * @param int $success crawling success count
     * @param int $duplicate crawling duplicate count
     * @param int $fail crawling fail count
     * @see release data -> \App\Release::CRAWLING_DATAS
     */
    public function update(?Command $command = null, $success = 0, $duplicate = 0, $fail = 0) {
        $datas = $this->release::getAllCrawlData();
        $this->print('릴리즈 크롤링 데이터 검색 건수: ' . count($datas));

        DB::beginTransaction();
        try {
            foreach ($datas as $type => $data) {
                $crawler = $this->crawler($data['site_url']);
                $version = $crawler->filter($data['version'])->text();

                if (isset($data['post'])) {
                    $crawler = $this->crawler($this->releaseInContent($data['post']['url'], $data['post']['before'], $data['post']['after'], $version));
                }

                $content = $crawler->filter($data['content'])->text();
                    
                if ($this->release::existTypeAndVersion($type, $this->releaseVersionCheck($version))) {
                    $duplicate++;
                    continue;
                }

                $this->release::create([
                    'site_url' => $data['site_url'],
                    'type' => $type,
                    'version' => $this->releaseVersionCheck($version),
                    'content' => $content
                ]);
                $success++;
            }
            DB::commit();
        } catch (\Exception $e) {
            $fail++;
            DB::rollBack();
            Log::debug($e);
            // return null;
        }

        $this->print('성공 건수: ' . $success);
        $this->print('중복 건수: ' . $duplicate);
        $this->print('실패 건수: ' . $fail);
    }

    /**
     * @param string $url
     * @return string
     */
    private function crawler(string $url) {
        $response = $this->client->get($url);
        $contents = $response->getBody()->getContents();
        $crawler = new Crawler($contents);

        return $crawler;
    }

    /**
     * @param string $type
     * @param string $version
     * @return string
     */
    private function releaseVersionCheck(string $version) {
        return preg_replace('/[^0-9_.-]/', '', trim($version));
    }

    /**
     * @param string $url
     * @param string $before
     * @param string $after
     * @param string $version
     * @return string
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
