<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use App\Tag;
use App\Viewcount;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except(['index', 'search', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $managedTags = Tag::getAllPrimaryTags();

        $weeklyDay = 300;
        $weeklyBestByTag = [];
        $weeklyBestByTag['All'] = Post::getLastBestPosts($weeklyDay, 5, Tag::getAllManagedTags());
        foreach ($managedTags as $tag) {
            $weeklyBestByTag[$tag] = Post::getLastBestPosts($weeklyDay, 5, Tag::MANAGED_TAGS[$tag]);
        }

        $latestPostsByTag = [];
        $latestPostsByTag['All'] = Post::getLatestPosts(5);
        foreach ($managedTags as $tag) {
            $latestPostsByTag[$tag] = Post::getLatestPosts(5, Tag::MANAGED_TAGS[$tag]);
        }

        return view('pages.posts.index', compact('weeklyBestByTag', 'latestPostsByTag'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  Post  $post
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function show(Post $post, Request $request)
    {
        Viewcount::increase($post, $request);

        //원본 블로그로 이동하게 한다
        $link = $post->link;

        if (substr($link, 0, 2) == '//') {
            $link = 'https:'.$link;
        }

        return redirect()->to($link);
        /*
        $relatedPosts = Post::whereBlogId($post->blog_id)->whereKeyNot($post->id)->limit(3)->get();
        return view('pages.posts.show', compact('post', 'relatedPosts'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        if (! auth()->check()) {
            throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
        }

        $user = auth()->user();

        $blogs = Blog::whereOwnerId($user->id)->get();

        Post::whereId($id)->whereIn('blog_id', $blogs)->delete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return RedirectResponse
     */
    public function restore($id)
    {
        if (! auth()->check()) {
            throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
        }

        $user = auth()->user();

        $blogs = Blog::whereOwnerId($user->id)->get();

        Post::withTrashed()->whereId($id)->whereIn('blog_id', $blogs)->restore();

        return back();
    }

    public function search(Request $request, ?string $tagName = '')
    {
        $keyword = $request->get('keyword');

        $posts = Post::with('blog', 'preview', 'tags');

        if ($keyword) {
            $posts->where('description', 'like', "%{$keyword}%");
        }

        if ($tagName) {
            $searchTagName = array_key_exists($tagName, Tag::MANAGED_TAGS) ? Tag::MANAGED_TAGS[$tagName] : [];
            $searchTagName[] = $tagName;

            $posts->whereHas('tags', function (Builder $q) use ($searchTagName) {
                $q->whereIn('name', $searchTagName);
            });
        }

        $posts->orderBy('published_at', 'desc');

        $posts = $posts->paginate(10);

        $tags = Tag::getAllPrimaryTags();

        return view('pages.posts.search', compact('keyword', 'posts', 'tags', 'tagName'));
    }
}
