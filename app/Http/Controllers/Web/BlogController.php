<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Blog\CreateRequest;
use App\Http\Requests\Web\Blog\DeleteRequest;
use App\Http\Requests\Web\Blog\EditRequest;
use App\Http\Requests\Web\Blog\RestoreRequest;
use App\Http\Requests\Web\Blog\StoreRequest;
use App\Http\Requests\Web\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\User;
use App\Services\Blog\Rss\Exceptions\CannotConnectFeedException;
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
        $this->middleware(['auth:web', 'verified'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        $blogs = Blog::crawledBlog()->get();

        return view('pages.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  CreateRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create(CreateRequest $request)
    {
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  StoreRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     * @throws CannotConnectFeedException
     */
    public function store(StoreRequest $request)
    {
        try {
            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            /**
             * @var User
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
     * @param  Blog  $blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function show(Blog $blog)
    {
        return redirect($blog->site_url);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  EditRequest  $request
     * @param  Blog  $blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit(EditRequest $request, Blog $blog)
    {
        return view('pages.blogs.edit', compact('blog'));
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Blog $blog)
    {
        try {
            $feed_url = $request->get('feed_url');

            ZendReader::import($feed_url);

            $blog->update($request->validated());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return back();
        } catch (InvalidArgumentException | ZendRuntimeException | RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  DeleteRequest  $request
     * @param  Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function destroy(DeleteRequest $request, Blog $blog)
    {
        $blog->delete();

        Toastr::success('블로그 삭제가 완료되었습니다. 관련된 게시글들은 노출에서 제외됩니다');

        return back();
    }

    /**
     * @param  RestoreRequest  $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(RestoreRequest $request, $id)
    {
        Blog::onlyTrashed()->findOrFail($id)->restore();

        Toastr::success('블로그 복구가 완료되었습니다. 관련된 게시글들은 노출이 재개됩니다');

        return back();
    }
}
