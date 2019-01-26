<?php


namespace Tests\Feature\Controllers;


use Tests\TestCase;

class HomeTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('home'))->assertOk();
        $this->get('/home')->assertRedirect('/');
    }
}