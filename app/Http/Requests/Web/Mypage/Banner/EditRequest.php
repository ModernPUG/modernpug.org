<?php

namespace App\Http\Requests\Web\Mypage\Banner;

use App\Models\User;
use App\Services\Banner\Exceptions\BannerPolicyException;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $banner = $this->route('banner');

        /**
         * @var User $user
         */
        $user = auth()->user();

        if ($user->cant('update', $banner)) {
            throw new BannerPolicyException($user);
        }

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
        ];
    }
}
