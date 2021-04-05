<?php

namespace App\Services\Point\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PolicyException extends AccessDeniedHttpException
{
    use ToastrWithBackRenderTrait;

    protected $message = '권한이 없습니다';
}
