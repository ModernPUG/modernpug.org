<?php

namespace App\Services\Blog\Rss;

use App\Models\Blog;
use App\Models\Post;
use App\Models\Tag;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Laminas\Feed\Reader\Entry\EntryInterface;
use Laminas\Feed\Reader\Feed\FeedInterface;

class PostUpdater
{
    /**
     * @var Client
     */
    private Client $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function fromFeed(FeedInterface $feed, Blog $blog)
    {

        /*
         * @var Entry
         */
        foreach ($feed as $entry) {
            $post = $this->updateBlogFromEntry($blog, $entry);
            $tags = $this->getTagIdsFromEntry($entry);

            $this->attachTags($post, $tags);
        }
    }

    /**
     * @param  Post  $post
     * @param  array  $tags
     */
    private function attachTags(Post $post, array $tags): void
    {
        $post->tags()->sync($tags);
    }

    /**
     * @param  Blog  $blog
     * @param  EntryInterface  $entry
     * @return Post
     */
    private function updateBlogFromEntry(Blog $blog, EntryInterface $entry): Post
    {
        $link = $this->makePostLink($entry);

        try {
            $this->guzzle->get($link);
        } catch (GuzzleException $exception) {
            Post::where('link', $link)->delete();
        }

        $description = $entry->getDescription();
        $published_at = $entry->getDateModified();

        /**
         * @var Post
         */
        $post = Post::withTrashed()->updateOrCreate(['blog_id' => $blog->id, 'link' => $link], [
            'title' => $entry->getTitle(),
            'link' => $link,
            'description' => $description,
            'published_at' => $published_at,
            'blog_id' => $blog->id,
        ]);

        return $post;
    }

    /**
     * @param $entry
     * @return string
     */
    private function makePostLink(EntryInterface $entry): string
    {
        $link = $entry->getLink();

        if (strpos($link, '//') === 0) {
            $link = 'https:'.$link;
        }

        return $link;
    }

    /**
     * @param  EntryInterface  $entry
     * @return int[]
     */
    private function getTagIdsFromEntry(EntryInterface $entry): array
    {
        $tagIds = [];

        foreach ($entry->getCategories() as $categoryInformation) {
            $categoryString = ! empty($categoryInformation['term']) ? $categoryInformation['term'] : $categoryInformation['label'];

            if (empty($categoryString)) {
                continue;
            }

            /**
             * @var Tag
             */
            $tag = Tag::firstOrCreate(['name' => $categoryString]);
            $tagIds[] = $tag->id;
        }

        if (count($tagIds) == 0) {
            $tagIds = $this->getTagsFromPost($entry);
        }

        return $tagIds;
    }

    private function getTagsFromPost(EntryInterface $entry): array
    {
        $autoTags = array_keys(Tag::MANAGED_TAGS);

        $tags = [];
        $content = $entry->getContent();

        foreach ($autoTags as $tag) {
            if (stripos($content, $tag)) {
                $tags[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
        }

        return $tags;
    }
}
