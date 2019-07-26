<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class SlackTest extends TestCase
{

    public function testIndex()
    {
        $this->get(route('slack.index'))->assertOk();
    }


    public function testSubmitInvalidEmail()
    {

        $this->post(route('slack.store'))
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->post(route('slack.store'), ['email' => '123'])
            ->assertSessionHasErrors('email')
            ->assertRedirect();

    }

    public function testSubmitInvalidReCaptcha()
    {

        $this->post(route('slack.store'), ['email' => 'test@example.com'])
            ->assertSessionHasErrors('recaptcha-token')
            ->assertRedirect();

    }
}
