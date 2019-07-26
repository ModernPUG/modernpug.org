<?php

namespace App\Http\Requests\Web\Slack;

use Illuminate\Foundation\Http\FormRequest;

class InviteRequest extends FormRequest
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
            'email' => 'required|email',
            'recaptcha-token' => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'recaptcha-token.required' => '비정상 접근입니다. 다시 시도해주세요',
            'recaptcha-token.recaptcha' => '비정상 접근입니다. 다시 시도해주세요',
        ];
    }
}
