<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class TagTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('tags.index'))->assertOk();
    }


}
