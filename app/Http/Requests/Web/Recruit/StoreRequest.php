<?php

namespace App\Http\Requests\Web\Recruit;

use App\Recruit;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use MessagesTrait;
    use AttributesTrait;

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
            'title' => 'required|string',
            'company_name' => 'required|string',
            'description' => 'required|string',
            'skills' => 'required|string',
            'link' => 'required|url',
            'image_url' => 'nullable|url',
            'address' => 'required|string',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer|greater_than_field:min_salary',
            'expired_at' => 'required|date|date_format:Y-m-d|after:today',
        ];
    }
}
