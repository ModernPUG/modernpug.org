<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class AboutUsTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('modernpug.aboutus'))->assertOk();
    }
}
