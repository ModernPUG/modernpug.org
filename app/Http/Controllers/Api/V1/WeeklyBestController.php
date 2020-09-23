<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\WeeklyBestRequest;
use App\Http\Resources\WeeklyBest as WeeklyBestResource;
use Illuminate\Database\Eloquent\Builder;

class WeeklyBestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  WeeklyBestRequest  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(WeeklyBestRequest $request)
    {
        $weeklyBests = \App\Models\WeeklyBest::with('posts')->when($request->year, function (Builder $builder) use ($request) {
            return $builder->where('year', $request->year);
        })->when($request->week_no, function (Builder $builder) use ($request) {
            return $builder->where('week_no', $request->week_no);
        })->paginate();

        return WeeklyBestResource::collection($weeklyBests);
    }
}
