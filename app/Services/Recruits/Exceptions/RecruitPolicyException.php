<?php


namespace App\Services\Recruits\Exceptions;


use App\Exceptions\ToastrWithRedirect;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RecruitPolicyException extends AccessDeniedHttpException
{

    use ToastrWithRedirect;

    protected $redirectTo = '/recruit';
}
