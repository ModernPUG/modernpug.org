<?php

namespace App\Http\Requests\Web\Blog;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Blog\Exceptions\BlogPolicyException;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $blog = $this->route('blog');

        /**
         * @var User
         */
        $user = auth()->user();
        $result = $user->can('edit', $blog);

        if (! $result) {
            throw new BlogPolicyException('블로그를 수정할 권한이 없습니다');
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
            //
        ];
    }
}
