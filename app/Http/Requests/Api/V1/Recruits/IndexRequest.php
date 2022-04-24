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
            'created_at' => ['nullable', 'date'],
            'created_from' => ['nullable', 'date'],
            'created_to' => ['nullable', 'date'],
            'closed_at' => ['nullable', 'date'],
            'closed_from' => ['nullable', 'date'],
            'closed_to' => ['nullable', 'date'],
        ];
    }
}
