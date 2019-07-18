<?php

namespace App\Http\Requests\Web\Mypage\User;

use App\Services\User\Exceptions\UserPolicyException;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $routeUser = $this->route('user');

        /**
         * @var User $user
         */
        $user = auth()->user();
        $result = $user->can('delete', $routeUser);

        if(!$result)
            throw new UserPolicyException('사용자를 삭제 할 권한이 없습니다');

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
