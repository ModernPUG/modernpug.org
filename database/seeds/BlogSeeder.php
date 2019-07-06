<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Blog::firstOrCreate([
            'feed_url' => 'http://88240.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://ani2life.com/wp/?feed=rss2',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://blog.appkr.kr/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://sangheon.com/feed',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://itzone.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://blog.decorus.io/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://b.redinfo.co.kr/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://ejnahc.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://edykim.com/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://heuristing.net/feed',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://jicjjang.github.io/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://laravelrocks.com/feed',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://findstar.pe.kr/index.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://blog.grotesq.com/feed',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://wafe.kr/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://webdir.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://geguri.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://ballogdev.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://l5.appkr.kr/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://blumine.blog.me/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://saksin.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://wani.kr/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'https://mytory.net/feed.xml',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://leehyunseok.com/?feed=rss2',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
        \App\Blog::firstOrCreate([
            'feed_url' => 'http://web-front-end.tistory.com/rss',
        ], [
            'title' => '',
            'site_url' => '',
        ]);
    }
}
