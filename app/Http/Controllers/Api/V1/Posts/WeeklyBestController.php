<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\WeeklyBestRequest;
use App\Http\Resources\WeeklyBest as WeeklyBestResource;
use App\Models\WeeklyBest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WeeklyBestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  WeeklyBestRequest  $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(WeeklyBestRequest $request)
    {
        $weeklyBests = WeeklyBest::with('posts')->when($request->year,
            function (Builder $builder) use ($request) {
                return $builder->where('year', $request->year);
            })->when($request->week_no, function (Builder $builder) use ($request) {
                return $builder->where('week_no', $request->week_no);
            })->paginate();

        return WeeklyBestResource::collection($weeklyBests);
    }
}
