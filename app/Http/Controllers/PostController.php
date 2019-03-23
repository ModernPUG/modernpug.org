<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use App\Tag;
use App\Viewcount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {

        Viewcount::create(['post_id' => $post->id, 'ip' => $request->ip()]);

        //원본 블로그로 이동하게 한다
        return redirect()->to($post->link);

        /*
        $relatedPosts = Post::whereBlogId($post->blog_id)->whereKeyNot($post->id)->limit(3)->get();
        return view('pages.posts.show', compact('post', 'relatedPosts'));
        */

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {


        if (!auth()->check()) {
            throw new UnauthorizedHttpException('','로그인 후 사용가능합니다');
        }

        $user = auth()->user();

        $blogs = Blog::whereEntryUserId($user->id)->get();

        Post::whereId($id)->whereIn('blog_id', $blogs)->delete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {


        if (!auth()->check()) {
            throw new UnauthorizedHttpException('','로그인 후 사용가능합니다');
        }

        $user = auth()->user();

        $blogs = Blog::whereEntryUserId($user->id)->get();

        Post::withTrashed()->whereId($id)->whereIn('blog_id', $blogs)->restore();

        return back();

    }


    public function search(Request $request, ?string $tagName = "")
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
