<?php

namespace App\Services\Blog;

use App\Blog;
use App\Services\Blog\Rss\BlogUpdater;
use App\Services\Blog\Rss\FeedParser;
use App\Services\Blog\Rss\PostUpdater;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Zend\Feed\Reader\Exception\RuntimeException as ZendFeedRuntimeException;
use Zend\Http\Client\Adapter\Exception\RuntimeException as ZendHttpRuntimeException;

class BlogFeedUpdater
{

    /**
     * @var Command|null
     */
    protected ?Command $command;
    /**
     * @var FeedParser
     */
    protected FeedParser $feedParser;
    /**
     * @var BlogUpdater
     */
    protected BlogUpdater $blogUpdater;
    /**
     * @var PostUpdater
     */
    protected PostUpdater $postUpdater;

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
                $this->print($blog->feed_url.' 시작');

                $feed = $this->feedParser->fromUrl($blog->feed_url);
                $this->blogUpdater->fromFeed($feed, $blog);
                $this->postUpdater->fromFeed($feed, $blog);

                $blog->crawled_at = now();
                $blog->crawling_fail_count = 0;
                $blog->last_crawling_failed_at = null;

                $blog->update();

                $this->print($blog->feed_url.' 종료');
            } catch (ZendFeedRuntimeException | ZendHttpRuntimeException $exception) {
                $blog->increment('crawling_fail_count', 1, ['last_crawling_failed_at' => now()]);
                $this->print($blog->feed_url);
                $this->print($blog->crawling_fail_count);

                if ($blog->crawling_fail_count >= Blog::AUTO_IGNORE_CRAWLING_FAIL_COUNT) {
                    $this->print($blog->feed_url." 중단합니다");
                    $blog->ignore_crawling = true;
                    $blog->save();
                }

                if (app()->environment() !== 'production') {
                    $this->print($exception->getMessage());
                }
            } catch (\Exception $exception) {
                if (app()->environment() === 'production' && app()->bound('sentry')) {
                    app('sentry')->captureException($exception);
                }
            }
        }
    }

    /**
     * @return Collection|Blog[]
     */
    private function getAllBlog()
    {
        return Blog::where('ignore_crawling', false)->orderBy('title', 'asc')->get();
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
