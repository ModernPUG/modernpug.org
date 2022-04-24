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
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
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

    public function index(): View
    {
        $blogs = Blog::withCount('posts')->latest('updated_at')->crawledBlog()->get();

        return view('pages.blogs.index', compact('blogs'));
    }

    public function create(CreateRequest $request): View
    {
        return view('pages.blogs.create');
    }

    public function store(StoreRequest $request): RedirectResponse
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

            toastr()->success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return redirect(route('blogs.create'));
        } catch (InvalidArgumentException|LaminasRuntimeException|RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    public function show(Blog $blog): RedirectResponse
    {
        return redirect($blog->site_url);
    }

    public function edit(EditRequest $request, Blog $blog): View
    {
        return view('pages.blogs.edit', compact('blog'));
    }

    public function update(UpdateRequest $request, Blog $blog): RedirectResponse
    {
        try {
            $feedUrl = $request->get('feed_url');

            LaminasReader::import($feedUrl);

            $blog->update($request->validated());

            toastr()->success('등록이 완료되었습니다. 사이트 글의 수집 및 반영까지는 최대 1시간까지 걸릴 수 있습니다');

            return back();
        } catch (InvalidArgumentException|LaminasRuntimeException|RuntimeException $exception) {
            throw new CannotConnectFeedException($exception->getMessage());
        }
    }

    public function destroy(DeleteRequest $request, Blog $blog): RedirectResponse
    {
        $blog->delete();

        toastr()->success('블로그 삭제가 완료되었습니다. 관련된 게시글들은 노출에서 제외됩니다');

        return back();
    }

    public function restore(RestoreRequest $request, $id): RedirectResponse
    {
        Blog::onlyTrashed()->findOrFail($id)->restore();

        toastr()->success('블로그 복구가 완료되었습니다. 관련된 게시글들은 노출이 재개됩니다');

        return back();
    }
}
