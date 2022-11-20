<?php

namespace App\Http\Controllers\Api\V1\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Threads\IndexRequest;
use App\Http\Resources\Thread as ThreadResource;
use App\Models\DiscordThread;
use Illuminate\Database\Eloquent\Builder;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $createdAt = $request->input('created_at');
        $createdFrom = $request->input('created_from');
        $createdTo = $request->input('created_to');

        $posts = DiscordThread::when($createdAt, function (Builder $builder) use ($createdAt) {
            $builder->whereBetween('created_at', [$createdAt.' 00:00:00', $createdAt.' 23:59:59']);
        })->when($createdFrom, function (Builder $builder) use ($createdFrom) {
            $builder->where('created_at', '>=', $createdFrom.' 00:00:00');
        })->when($createdTo, function (Builder $builder) use ($createdTo) {
            $builder->where('created_at', '<=', $createdTo.' 23:59:59');
        })->get();

        return ThreadResource::collection($posts);
    }
}
