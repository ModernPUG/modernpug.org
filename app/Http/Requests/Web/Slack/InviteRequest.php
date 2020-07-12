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
            config('recaptcha.validation-key') => 'required|recaptcha',
        ];
    }

    public function messages()
    {
        return [
            config('recaptcha.validation-key') . '.required' => '비정상 접근입니다. 다시 시도해주세요',
            config('recaptcha.validation-key') . '.recaptcha' => '비정상 접근입니다. 다시 시도해주세요',
        ];
    }
}
