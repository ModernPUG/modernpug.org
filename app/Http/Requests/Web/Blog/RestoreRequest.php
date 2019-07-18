<?php

namespace App\Http\Requests\Web\Blog;

use App\Blog;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Blog\Exceptions\BlogPolicyException;

class RestoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $blog = Blog::onlyTrashed()->findOrFail($this->route('blog'));

        /**
         * @var User
         */
        $user = auth()->user();
        $result = $user->can('restore', $blog);

        if (! $result) {
            throw new BlogPolicyException('블로그를 복구 할 권한이 없습니다');
        }

        return $result;
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
