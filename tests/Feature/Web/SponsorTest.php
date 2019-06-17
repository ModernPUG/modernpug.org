<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class SponsorTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('sponsors.index'))->assertOk();
    }
}
