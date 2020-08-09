<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class WeeklyBest
 * @mixin \App\WeeklyBest
 */
class WeeklyBest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'year' => $this->year,
            'week_no' => $this->week_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'posts'=> Post::collection($this->posts),
        ];
    }
}
