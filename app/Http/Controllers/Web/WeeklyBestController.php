<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Blog\WeeklyBestRequest;
use App\Models\Banner;
use App\Models\WeeklyBest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WeeklyBestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  WeeklyBestRequest  $request
     * @param  WeeklyBest  $weeklyBest
     * @return Application|Factory|Response|View
     */
    public function __invoke(WeeklyBestRequest $request, WeeklyBest $weeklyBest)
    {
        $weeklyBests = WeeklyBest::latest()->get();

        if (! $weeklyBest->id) {
            $weeklyBest = $weeklyBests->when($request->year, function (Builder $builder) use ($request) {
                return $builder->where('year', $request->year);
            })->when($request->week_no, function (Builder $builder) use ($request) {
                return $builder->where('week_no', $request->week_no);
            })->first()->load('posts.preview', 'posts.blog', 'posts.tags') ?? new WeeklyBest();
        }

        $banners = Banner::getActiveBanners();

        return view('pages.posts.weekly', compact('weeklyBests', 'weeklyBest', 'banners'));
    }
}
