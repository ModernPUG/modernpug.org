<?php

namespace App\Http\Requests\Web\Blog;

use App\Models\Blog;
use App\Models\User;
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

        /**
         * @var User
         */
        $user = auth()->user();

        return $user->can('create', Blog::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'feed_url'=>'required|url',
            'comment'=>'nullable|string',
        ];
    }
}
