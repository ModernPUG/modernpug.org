<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class ReleaseNewsTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('news.releases.index'))->assertOk();
    }


}
