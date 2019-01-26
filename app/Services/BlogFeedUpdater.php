<?php

namespace App\Services;

use App\Blog;
use App\Services\Rss\PostUpdater;
use App\Services\Rss\BlogUpdater;
use App\Services\Rss\FeedParser;
use Illuminate\Console\Command;
use Zend\Feed\Reader\Exception\RuntimeException as ZendFeedRuntimeException;

class BlogFeedUpdater
{
    protected $lastError;
    /**
     * @var Command
     */
    protected $command;
    /**
     * @var FeedParser
     */
    protected $feedParser;
    /**
     * @var BlogUpdater
     */
    protected $blogUpdater;
    /**
     * @var PostUpdater
     */
    protected $postUpdater;

    public function __construct(
        FeedParser $feedParser,
        BlogUpdater $blogUpdater,
        PostUpdater $postUpdater
    ) {
        $this->feedParser = $feedParser;
        $this->blogUpdater = $blogUpdater;
        $this->postUpdater = $postUpdater;
    }


    public function updateAllBlog(?Command $command = null)
    {
        $this->command = $command;

        foreach ($this->getAllBlog() as $blog) {

            try {

                $this->print($blog->feed_url . " 시작");

                $feed = $this->feedParser->fromUrl($blog->feed_url);
                $this->blogUpdater->fromFeed($feed, $blog);
                $this->postUpdater->fromFeed($feed, $blog);
                $this->print($blog->feed_url . " 종료");

            } catch (ZendFeedRuntimeException $exception) {

                $this->print($exception->getMessage());

            }
        }
    }

    private function getAllBlog()
    {
        return Blog::orderBy('title', 'asc')->get();
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
