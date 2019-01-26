<?php


namespace Tests\Feature\Controllers;


use Tests\TestCase;

class RecruitTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('recruit.index'))->assertOk();
    }
}