<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogStoreRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Zend\Feed\Reader\Reader as ZendReader;
use Toastr;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if(auth()->check())
            $myBlogs = Blog::whereEntryUserId(auth()->id())->get();
        else
            $myBlogs=[];

        $blogs = Blog::getCrawledBlog();

        return view('pages.blogs.index',compact('blogs','myBlogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {
            if (!auth()->check()) {
                throw new UnauthorizedHttpException('','로그인 후 사용가능합니다');
            }

            return view('pages.blogs.create');
        }
        catch (UnauthorizedHttpException $exception)
        {
            Toastr::error($exception->getMessage());

            return redirect(route('blogs.index'));
        }

    }

    /**
     * Store a newly created resource in storage.
     * @param BlogStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogStoreRequest $request)
    {


        try {
            if(!auth()->check())
                throw new UnauthorizedHttpException('','로그인 후 사용가능합니다');

            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            $args = $request->all();
            $args['entry_user_id']=auth()->id();
            $blog = new Blog($args);
            $blog->save();

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');
        }
        catch (AccessDeniedHttpException $exception)
        {
            Toastr::error($exception->getMessage());
            return redirect(route('blogs.index'));
        }
        catch (\Zend\Http\Exception\InvalidArgumentException  $exception)
        {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        }
        catch (\Zend\Http\Client\Adapter\Exception\RuntimeException  $exception)
        {
            $request->flash();
            Toastr::error('feed에 접속이 되지 않습니다');
        }
        catch (\Zend\Feed\Exception\RuntimeException $exception)
        {
            $request->flash();
            Toastr::error('지원하지 않는 feed 양식입니다');
        }
        catch (\Exception $exception)
        {
            \Sentry::captureException($exception);
            $request->flash();
            Toastr::error('알 수 없는 오류입니다. 관리자에게 연락주시기 바랍니다');
        }

        return redirect(route('blogs.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return redirect($blog->site_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogStoreRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->check())
            throw new AccessDeniedHttpException();


        $blog = Blog::findOrFail($id);

        if(auth()->id() != $blog->entry_user_id)
            throw new AccessDeniedHttpException();

        //TODO blog soft 삭제처리 추가 및 게시글 감춤처리 추가
    }
}
