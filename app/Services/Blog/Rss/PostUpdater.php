<?php

namespace App\Services\Blog\Rss;

use App\Blog;
use App\Post;
use App\Tag;
use Zend\Feed\Reader\Entry\EntryInterface;
use Zend\Feed\Reader\Feed\FeedInterface;

class PostUpdater
{
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
     * @param Post $post
     * @param array $tags
     */
    private function attachTags(Post $post, array $tags): void
    {
        $post->tags()->sync($tags);
    }

    /**
     * @param Blog $blog
     * @param EntryInterface $entry
     * @return Post
     */
    private function updateBlogFromEntry(Blog $blog, EntryInterface $entry): Post
    {
        $link = $this->makePostLink($entry);
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
     * @param EntryInterface $entry
     * @return int[]
     */
    private function getTagIdsFromEntry(EntryInterface $entry): array
    {
        $tags = [];

        foreach ($entry->getCategories() as $category) {
            /**
             * @var Tag
             */
            $tag = Tag::firstOrCreate(['name' => $category['label']]);
            $tags[] = $tag->id;
        }

        return $tags;
    }
}
