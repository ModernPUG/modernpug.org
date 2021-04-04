<?php

namespace App\Http\Requests\Web\Mypage\Banner;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'url' => ['required'],
            'position' => ['required'],
            'started_at' => ['required'],
            'closed_at' => ['required'],
            'image' => ['required', 'image'],
        ];
    }
}
