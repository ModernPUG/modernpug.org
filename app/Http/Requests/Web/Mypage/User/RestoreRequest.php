<?php

namespace App\Http\Requests\Web\Mypage\User;

use App\Blog;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class RestoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $routeUser = User::onlyTrashed()->findOrFail($this->route('user'));

        /**
         * @var User $user
         */
        $user = auth()->user();
        return $user->can('restore', $routeUser);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
