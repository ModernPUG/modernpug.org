<?php

namespace App\Http\Requests\Web\Recruit;

use App\Recruit;
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
        $recruit = Recruit::onlyTrashed()->findOrFail($this->route('recruit'));

        /**
         * @var User $user
         */
        $user = auth()->user();
        return $user->can('restore', $recruit);
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
