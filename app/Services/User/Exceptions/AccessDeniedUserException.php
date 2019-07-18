<?php

namespace App\Services\User\Exceptions;

use App\Exceptions\ToastrWithRedirect;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AccessDeniedUserException extends AccessDeniedHttpException
{
    use ToastrWithRedirect;

    protected $redirect = '/';
}
