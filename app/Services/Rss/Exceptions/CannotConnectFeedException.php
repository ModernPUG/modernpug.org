<?php


namespace App\Services\Rss\Exceptions;


use App\Exceptions\ToastrWithBackRenderTrait;

class CannotConnectFeedException extends \Exception
{
    use ToastrWithBackRenderTrait;

}
