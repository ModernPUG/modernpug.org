<?php

namespace App\Http\Controllers;

use Sentry;
use Toastr;
use App\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BlogStoreRequest;
use Zend\Feed\Exception\RuntimeException;
use Zend\Feed\Reader\Reader as ZendReader;
use Zend\Http\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified')->except('index');
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
        try {
            if (! auth()->check()) {
                throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
            }

            return view('pages.blogs.create');
        } catch (UnauthorizedHttpException $exception) {
            Toastr::error($exception->getMessage());

            return redirect(route('blogs.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param BlogStoreRequest $request
     * @return Response
     */
    public function store(BlogStoreRequest $request)
    {
        try {
            if (! auth()->check()) {
                throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
            }

            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            $args = $request->all();
            $args['owner_id'] = auth()->id();
            $blog = new Blog($args);
            $blog->save();

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');
        } catch (AccessDeniedHttpException $exception) {
            Toastr::error($exception->getMessage());

            return redirect(route('blogs.index'));
        } catch (InvalidArgumentException  $exception) {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        } catch (\Zend\Http\Client\Adapter\Exception\RuntimeException  $exception) {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        } catch (RuntimeException $exception) {
            $request->flash();
            Toastr::error('지원하지 않는 feed 양식입니다');
        } catch (Exception $exception) {
            Sentry::captureException($exception);
            $request->flash();
            Toastr::error('알 수 없는 오류입니다. 관리자에게 연락주시기 바랍니다');
        }

        return redirect(route('blogs.create'));
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
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (! auth()->check()) {
            throw new AccessDeniedHttpException();
        }

        $blog = Blog::findOrFail($id);

        if (auth()->id() != $blog->owner_id) {
            throw new AccessDeniedHttpException();
        }

        $blog = Blog::findOrFail($id);

        return view('pages.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(BlogStoreRequest $request, $id)
    {
        try {
            if (! auth()->check()) {
                throw new AccessDeniedHttpException();
            }

            $blog = Blog::findOrFail($id);

            if (auth()->id() != $blog->owner_id) {
                throw new AccessDeniedHttpException();
            }

            if (! auth()->check()) {
                throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
            }

            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            $blog->save($request->toArray());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');
        } catch (AccessDeniedHttpException $exception) {
            Toastr::error($exception->getMessage());

            return redirect(route('blogs.index'));
        } catch (InvalidArgumentException  $exception) {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        } catch (\Zend\Http\Client\Adapter\Exception\RuntimeException  $exception) {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        } catch (RuntimeException $exception) {
            $request->flash();
            Toastr::error('지원하지 않는 feed 양식입니다');
        } catch (Exception $exception) {
            Sentry::captureException($exception);
            $request->flash();
            Toastr::error('알 수 없는 오류입니다. 관리자에게 연락주시기 바랍니다');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        if (! auth()->check()) {
            throw new AccessDeniedHttpException();
        }

        $blog = Blog::findOrFail($id);

        if (auth()->id() != $blog->owner_id) {
            throw new AccessDeniedHttpException();
        }

        $blog->delete();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function restore($id)
    {
        if (! auth()->check()) {
            throw new UnauthorizedHttpException('', '로그인 후 사용가능합니다');
        }

        $blog = Blog::withTrashed()->findOrFail($id);

        if (auth()->id() != $blog->owner_id) {
            throw new AccessDeniedHttpException();
        }

        $blog->restore();

        return back();
    }
}
