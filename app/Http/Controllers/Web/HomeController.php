<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Tag;
use App\Models\WeeklyBest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|Response|View
     */
    public function __invoke()
    {
        /**
         * @var WeeklyBest $latestWeeklyBest
         */
        $latestWeeklyBest = WeeklyBest::with('posts.preview', 'posts.blog')->latest()->firstOrNew();

        $latestPosts = Post::getLatestPosts(4, Tag::getAllManagedTags())->load('preview', 'blog');

        $banners = Banner::getActiveBanners(Banner::POSITION_LNB);

        return view('pages.home.index', compact('latestWeeklyBest', 'latestPosts', 'banners'));
    }
}
