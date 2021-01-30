<?php

namespace App\Services\Blog\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AlreadyExistsException extends BadRequestException
{
    use ToastrWithBackRenderTrait;

    protected $message = '이미 등록된 블로그입니다';
}
