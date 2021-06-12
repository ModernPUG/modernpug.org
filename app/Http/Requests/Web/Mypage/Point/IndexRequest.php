<?php

namespace App\Http\Requests\Web\Mypage\Point;

use App\Models\Point;
use App\Models\User;
use App\Services\Point\Exceptions\PolicyException;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        $result = $user->can('view', Point::class);

        if (! $result) {
            throw new PolicyException();
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
