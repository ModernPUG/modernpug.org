<?php


namespace App\Services\Rss\Exceptions;


use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RequestNotOwnedBlogException extends AccessDeniedHttpException
{

    use ToastrWithBackRenderTrait;

    protected $message = '블로그의 소유자가 아닙니다';
}
