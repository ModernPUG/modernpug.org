<?php


namespace Tests\Feature\Controllers;


use Tests\TestCase;

class BlogTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('blogs.index'))->assertOk();
    }

    public function testCreate()
    {
        $this->get(route('blogs.create'))->assertStatus(302);
    }
}