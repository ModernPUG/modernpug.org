<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class AboutUsTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('modernpug.aboutus'))->assertOk();
    }
}
