<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Recruits\IndexRequest;
use App\Http\Resources\Recruit as RecruitResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RecruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {

        $createdAt = $request->input('created_at');
        $createdFrom = $request->input('created_from');
        $createdTo = $request->input('created_to');

        $recruits = \App\Models\Recruit::where('expired_at', '>=', Carbon::today())
            ->when($createdAt, function (Builder $builder) use ($createdAt) {
                $builder->whereBetween('created_at', [$createdAt.' 00:00:00', $createdAt.' 23:59:59']);
            })
            ->when($createdFrom, function (Builder $builder) use ($createdFrom) {
                $builder->where('created_at', '>=', $createdFrom.' 00:00:00');
            })
            ->when($createdTo, function (Builder $builder) use ($createdTo) {
                $builder->where('created_at', '<=', $createdTo.' 23:59:59');
            })
            ->get();


        return RecruitResource::collection($recruits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RecruitResource
     */
    public function show($id)
    {
        return new RecruitResource(\App\Models\Recruit::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }
}
