<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Mypage\Banner\DeleteRequest;
use App\Http\Requests\Web\Mypage\Banner\EditRequest;
use App\Http\Requests\Web\Mypage\Banner\IndexRequest;
use App\Http\Requests\Web\Mypage\Banner\StoreRequest;
use App\Http\Requests\Web\Mypage\Banner\UpdateRequest;
use App\Models\Banner;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index(IndexRequest $request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();
        $banners = Banner::with('create_user', 'approve_user')
            ->when($user->cant('banner-list'), function (Builder $builder) use ($user) {
                return $builder->where('create_user_id', $user->id);
            })
            ->paginate(10);

        return view('pages.mypage.banner.index', compact('banners'));
    }

    public function create(Banner $banner)
    {
        return view('pages.mypage.banner.form', compact('banner'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $uuid = Str::UUID();
        $file = new File();

        $image = $request->file('image');
        $filePath = $image->storeAs('banners', $uuid, 'public');

        $file->id = $uuid;
        $file->name = $image->getClientOriginalName();
        $file->file_path = '/storage/'.$filePath;
        $file->mime = $image->getClientMimeType();
        $file->size = $image->getSize();

        $banner = new Banner($request->validated());
        $banner->create_user()->associate($request->user())->save();
        $banner->images()->save($file);

        return redirect()->route('mypage.banners.edit', [$banner]);
    }

    public function show(Banner $banner)
    {
        //
    }

    public function edit(EditRequest $request, Banner $banner)
    {
        return view('pages.mypage.banner.form', compact('banner'));
    }

    public function update(UpdateRequest $request, Banner $banner): RedirectResponse
    {
        $image = $request->file('image');
        if ($image) {
            $uuid = Str::UUID();

            $file = new File();
            $filePath = $image->storeAs('banners', $uuid, 'public');

            $file->id = $uuid;
            $file->name = $image->getClientOriginalName();
            $file->file_path = '/storage/'.$filePath;
            $file->mime = $image->getClientMimeType();
            $file->size = $image->getSize();
            $banner->images()->save($file);
        }

        $banner->update($request->validated());

        toastr()->success('저장되었습니다');

        return back();
    }

    public function destroy(DeleteRequest $request, Banner $banner): RedirectResponse
    {
        $banner->delete();

        toastr()->success('삭제되었습니다');

        return redirect()->route('mypage.banners.index');
    }
}
