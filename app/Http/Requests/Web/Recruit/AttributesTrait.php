<?php


namespace App\Http\Requests\Web\Recruit;


trait AttributesTrait
{

    public function attributes()
    {
        return [

            'title' => '채용',
            'company_name' => '회사명',
            'description' => '간단 설명',
            'skills' => '우대 기술',
            'link' => '채용 링크',
            'address' => '근무지',
            'min_salary' => '최소 연봉',
            'max_salary' => '최대 연봉',
            'expired_at' => '채용 종료일',
        ];
    }

}
