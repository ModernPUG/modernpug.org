<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /**
         * @var Collection $blogs
         */
        $blogs = Blog::withTrashed()->withCount('posts')->whereOwnerId($user->id)->get();

        $posts = Post::withTrashed()
            ->with('blog', 'preview')
            ->withCount('viewcount')
            ->whereIn('blog_id', $blogs->pluck('id'))
            ->paginate(10);

        return view('pages.mypage.dashboard.index', compact('blogs', 'posts'));
    }
}
