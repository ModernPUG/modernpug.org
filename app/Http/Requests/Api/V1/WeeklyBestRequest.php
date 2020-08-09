<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class WeeklyBestRequest
 * @property-read int|null $year
 * @property-read int|null $week_no
 */
class WeeklyBestRequest extends FormRequest
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
            'year' => 'nullable|numeric',
            'week_no' => 'nullable|numeric',
        ];
    }
}
