<?php


namespace Tests\Feature\Controllers;


use Tests\TestCase;

class SponsorTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('sponsors.index'))->assertOk();
    }
}