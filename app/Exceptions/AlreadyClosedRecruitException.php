<?php

namespace App\Exceptions;

use Exception;

class AlreadyClosedRecruitException extends Exception
{
    protected $message = '이미 마감된 채용공고입니다.';
}
