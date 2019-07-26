<?php

namespace App\Services\Blog\Rss\Exceptions;

use App\Exceptions\ToastrWithBackRenderTrait;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CannotConnectFeedException extends BadRequestHttpException
{
    use ToastrWithBackRenderTrait;
}
