<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class PostTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('posts.index'))->assertOk();
    }

    public function testCreate()
    {
        $this->get(route('posts.search'))->assertOk();
    }
}
