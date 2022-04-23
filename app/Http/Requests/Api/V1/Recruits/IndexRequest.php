<?php

namespace App\Http\Requests\Api\V1\Recruits;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'created_at' => 'date',
            'created_from' => 'date',
            'created_to' => 'date',
            'closed_at' => 'date',
            'closed_from' => 'date',
            'closed_to' => 'date',
        ];
    }
}
