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
use App\Services\Blog\Exceptions\AlreadyExistsException;
use App\Services\Blog\Rss\Exceptions\CannotConnectFeedException;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Toastr;
use Laminas\Feed\Exception\RuntimeException;
use Laminas\Feed\Reader\Reader as LaminasReader;
use Laminas\Http\Client\Adapter\Exception\RuntimeException as LaminasRuntimeException;
use Laminas\Http\Exception\InvalidArgumentException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $blogs = Blog::crawledBlog()->get();

        return view('pages.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  CreateRequest  $request
     * @return Application|Factory|Response|View
     */
    public function create(CreateRequest $request)
    {
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  StoreRequest  $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws CannotConnectFeedException
     */
    public function store(StoreRequest $request)
    {
        try {
            $feedUrl = $request->get('feed_url');

            LaminasReader::import($feedUrl);

            if (Blog::where('feed_url', '=', $feedUrl)->exists()) {
                throw new AlreadyExistsException();
            }

            /**
             * @var User $user
             */
            $user = auth()->user();
            $user->blogs()->create($request->validated());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return redirect(route('blogs.create'));
        } catch (InvalidArgumentException | LaminasRuntimeException | RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param  Blog  $blog
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show(Blog $blog)
    {
        return redirect($blog->site_url);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  EditRequest  $request
     * @param  Blog  $blog
     * @return Application|Factory|Response|View
     */
    public function edit(EditRequest $request, Blog $blog)
    {
        return view('pages.blogs.edit', compact('blog'));
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Blog  $blog
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Blog $blog)
    {
        try {
            $feedUrl = $request->get('feed_url');

            LaminasReader::import($feedUrl);

            $blog->update($request->validated());

            Toastr::success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return back();
        } catch (InvalidArgumentException | LaminasRuntimeException | RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  DeleteRequest  $request
     * @param  Blog  $blog
     * @return RedirectResponse
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
     * @return RedirectResponse
     */
    public function restore(RestoreRequest $request, $id)
    {
        Blog::onlyTrashed()->findOrFail($id)->restore();

        Toastr::success('블로그 복구가 완료되었습니다. 관련된 게시글들은 노출이 재개됩니다');

        return back();
    }
}
