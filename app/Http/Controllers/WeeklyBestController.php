<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\Blog\WeeklyBestRequest;
use App\WeeklyBest;
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
        $weeklyBests = WeeklyBest::all();

        if (!$weeklyBest->id) {
            $weeklyBest = $weeklyBests->when($request->year, function (Builder $builder) use ($request) {
                return $builder->where('year', $request->year);
            })->when($request->week_no, function (Builder $builder) use ($request) {
                return $builder->where('week_no', $request->week_no);
            })->last();
        }

        return view('pages.posts.weekly', compact('weeklyBests', 'weeklyBest'));
    }
}
