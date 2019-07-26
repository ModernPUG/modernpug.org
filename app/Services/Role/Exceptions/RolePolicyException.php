<?php

namespace App\Services\Role\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RolePolicyException extends AccessDeniedHttpException
{
    use ToastrWithBackRenderTrait;
}
