<?php

namespace App\Services\Recruits\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RecruitPolicyException extends UnauthorizedHttpException
{
    use ToastrWithBackRenderTrait;

    protected $redirectTo = '/recruits';
}
