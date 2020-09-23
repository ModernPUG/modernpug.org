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
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Symfony\Component\DomCrawler\Crawler;

class PreviewUpdater
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Command
     */
    protected $command;
    /**
     * @var InvalidImageFilter
     */
    protected $invalidImageFilter;

    public function __construct(Client $client, InvalidImageFilter $invalidImageFilter)
    {
        $this->client = $client;
        $this->invalidImageFilter = $invalidImageFilter;
    }

    public function update(?Command $command = null)
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

    private function searchImageUnregisteredPosts()
    {
        return Post::whereNotIn('id', function (Builder $builder) {
            $builder->select('post_id')->from('previews');
        })->get();
    }

    private function getTargetBlogs()
    {

        //return Blog::whereNull('image_url')->get();
        return Blog::all();
    }

    private function parseBlogImageUrl(Blog $blog)
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
        } catch (\Exception $exception) {
            return null;
        }
    }

    private function getImageUrlBaseOgImage(string $url): ?string
    {
        try {
            $info = Embed::create($url);

            $info->image = $this->invalidImageFilter->filter($info->image);

            return $info->image;
        } catch (\Exception $exception) {
            return null;
        }
    }

    private function parsePostImageUrl(Post $post)
    {
        $imageUrl = $this->getImageUrlBaseOgImage($post->link);

        if ($imageUrl) {
            $preview = new Preview;
            $preview->image_url = $imageUrl;
            $preview->post_id = $post->id;
            $preview->save();
        }
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
