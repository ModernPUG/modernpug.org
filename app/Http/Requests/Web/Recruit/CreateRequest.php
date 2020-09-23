<?php

namespace App\Http\Requests\Web\Recruit;

use App\Models\Recruit;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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

        return $user->can('create', Recruit::class);
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
