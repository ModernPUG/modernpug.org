<?php

namespace App\Services\User\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserPolicyException extends AccessDeniedHttpException
{
    use ToastrWithBackRenderTrait;
}
