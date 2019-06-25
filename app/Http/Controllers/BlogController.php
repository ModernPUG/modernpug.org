<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogStoreRequest;
use App\Services\Rss\Exceptions\CannotConnectFeedException;
use App\User;
use Exception;
use Illuminate\Http\Response;
use Toastr;
use Zend\Feed\Exception\RuntimeException;
use Zend\Feed\Reader\Reader as ZendReader;
use Zend\Http\Client\Adapter\Exception\RuntimeException as ZendRuntimeException;
use Zend\Http\Exception\InvalidArgumentException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except(['index', 'show']);
        $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $blogs = Blog::getCrawledBlog();

        return view('pages.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param BlogStoreRequest $request
     * @return Response
     * @throws CannotConnectFeedException
     */
    public function store(BlogStoreRequest $request)
    {

        try {
            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            /**
             * @var User $user
             */
            $user = auth()->user();
            $user->blogs()->create($request->validated());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return redirect(route('blogs.create'));
        } catch (InvalidArgumentException | ZendRuntimeException | RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return redirect($blog->site_url);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Blog $blog
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        return view('pages.blogs.edit', compact('blog'));
    }

    /**
     * @param BlogStoreRequest $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse
     * @throws CannotConnectFeedException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BlogStoreRequest $request, Blog $blog)
    {
        try {

            $this->authorize('update', $blog);

            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            $blog->save($request->validated());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return back();

        } catch (InvalidArgumentException | ZendRuntimeException | RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param Blog $blog
     * @return Response
     * @throws Exception
     */
    public function destroy(Blog $blog)
    {

        $this->authorize('destroy', $blog);

        $blog->delete();

        Toastr::success('블로그 삭제가 완료되었습니다. 관련된 게시글들은 노출에서 제외됩니다');

        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {


        $blog = Blog::withTrashed()->findOrFail($id);

        $this->authorize('restore', $blog);

        $blog->restore();

        return back();
    }

}
