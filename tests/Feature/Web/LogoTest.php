<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class LogoTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('modernpug.logo'))->assertOk();
    }
}
