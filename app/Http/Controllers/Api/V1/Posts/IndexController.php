<?php

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\IndexRequest;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $createdAt = $request->input('created_at');
        $createdFrom = $request->input('created_from');
        $createdTo = $request->input('created_to');

        $posts = Post::when($createdAt, function (Builder $builder) use ($createdAt) {
            $builder->whereBetween('created_at', [$createdAt.' 00:00:00', $createdAt.' 23:59:59']);
        })->when($createdFrom, function (Builder $builder) use ($createdFrom) {
            $builder->where('created_at', '>=', $createdFrom.' 00:00:00');
        })->when($createdTo, function (Builder $builder) use ($createdTo) {
            $builder->where('created_at', '<=', $createdTo.' 23:59:59');
        })->get();

        return PostResource::collection($posts);
    }
}
