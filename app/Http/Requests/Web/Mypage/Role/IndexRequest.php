<?php

namespace App\Http\Requests\Web\Mypage\Role;

use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Role\Exceptions\RolePolicyException;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the Role is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        /**
         * @var User $user
         */
        $user = auth()->user();

        $result = $user->can('view', Role::class);

        if (! $result) {
            throw new RolePolicyException('Role을 조회 할 권한이 없습니다');
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
