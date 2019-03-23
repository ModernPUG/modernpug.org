<?php


namespace App\Http\Controllers\Mypage;


use App\Blog;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function show()
    {

        $user = auth()->user();

        $blogs = Blog::withTrashed()->withCount('posts')->whereEntryUserId($user->id)->get();

        $posts = Post::withTrashed()->with('blog','preview')->withCount('viewcount')->whereIn('blog_id',$blogs)->paginate(10);;
        return view('pages.mypage.dashboard.show', compact('blogs','posts'));
    }


}