<?php


namespace App\Services\Blog\Exceptions;


use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AlreadyExistsException extends BadRequestException
{

    protected $message = "이미 등록된 블로그입니다";

}
