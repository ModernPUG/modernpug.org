<?php

namespace App\Services\Blog\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BlogPolicyException extends AccessDeniedHttpException
{
    use ToastrWithBackRenderTrait;
}
