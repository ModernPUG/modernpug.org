<?php

namespace App\Services\Banner\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class BannerPolicyException extends UnauthorizedHttpException
{
    use ToastrWithBackRenderTrait;

    protected $message = '권한이 없습니다';
}
