<?php

namespace App\Http\Requests\Web\Recruit;

trait MessagesTrait
{
    public function messages()
    {
        return [
            'max_salary.greater_than_field' => '최대 연봉은 최소연봉보다 커야합니다',
        ];
    }
}
