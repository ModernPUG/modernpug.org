<?php


namespace App\Services\Rss\Exceptions;


use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BlogPolicyException extends AccessDeniedHttpException
{

    use ToastrWithBackRenderTrait;

}
