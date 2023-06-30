<?php
/**
 * Created by PhpStorm.
 * User: kkame
 * Date: 18. 12. 2
 * Time: 오후 7:54.
 */

namespace App\Services\Blog;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Preview;
use Embed\Embed;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Symfony\Component\DomCrawler\Crawler;

class PreviewUpdater
{
    protected ?Command $command;

    public function __construct(
        protected Client $client,
        protected InvalidImageFilter $invalidImageFilter,
        protected Embed $embed
    ) {
    }

    public function update(?Command $command = null): void
    {
        $this->command = $command;

        $blogs = $this->getTargetBlogs();
        $this->print('블로그 : '.$blogs->count().'건 검색시작');
        foreach ($blogs as $blog) {
            $this->parseBlogImageUrl($blog);
        }
        $this->print('블로그 검색완료');

        $posts = $this->searchImageUnregisteredPosts();
        $this->print('게시글 : '.$posts->count().'건 검색시작');
        foreach ($posts as $post) {
            $this->parsePostImageUrl($post);
        }
        $this->print('게시글 검색완료');
    }

    private function searchImageUnregisteredPosts(): iterable
    {
        return Post::whereNotIn('id', function (Builder $builder) {
            $builder->select('post_id')->from('previews');
        })->get();
    }

    private function getTargetBlogs(): iterable
    {
        //return Blog::whereNull('image_url')->get();
        return Blog::all();
    }

    private function parseBlogImageUrl(Blog $blog): void
    {
        $imageUrl = $this->getImageUrlBaseFeed($blog->feed_url);

        if (empty($imageUrl)) {
            $imageUrl = $this->getImageUrlBaseOgImage($blog->site_url);
        }

        $blog->image_url = $imageUrl;
        $blog->save();
    }

    private function getImageUrlBaseFeed(string $url): ?string
    {
        try {
            $response = $this->client->get($url);
            $contents = $response->getBody()->getContents();
            $crawler = new Crawler($contents);

            return $crawler->filter('image url')->text();
        } catch (Exception) {
            return null;
        }
    }

    private function getImageUrlBaseOgImage(string $url): ?string
    {
        try {
            $info = $this->embed->get($url);

            return $info->image ? $this->invalidImageFilter->filter($info->image) : null;
        } catch (Exception) {
            return null;
        }
    }

    private function parsePostImageUrl(Post $post): void
    {
        $imageUrl = $this->getImageUrlBaseOgImage($post->link);

        if ($imageUrl) {
            $preview = new Preview();
            $preview->image_url = $imageUrl;
            $preview->post_id = $post->id;
            $preview->save();
        }
    }

    private function print(string $message): void
    {
        if ($this->command) {
            $this->command->info($message);
        } else {
            dump($message);
        }
    }
}
