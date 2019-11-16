<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Recruit extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var \App\Recruit $this
         */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'skills' => $this->skills,
            'link' => $this->link,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'expired_at' => $this->expired_at,
            'created_user' => $this->entry_user->name,
        ];
    }
}
