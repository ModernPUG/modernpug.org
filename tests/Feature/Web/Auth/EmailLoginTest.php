<?php

namespace Tests\Feature\Web\Auth;

use App\User;
use App\Validators\ReCaptcha;
use Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EmailLoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testSeeLoginForm()
    {
        $this->get(route('login'))->assertOk();
    }

    public function testSubmitInvalidReCaptcha()
    {
        $this->post(route('login'), ['email' => 'test@example.com'])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();

        $this->post(route('login'), [
            'email' => 'test@example.com',
            config('recaptcha.validation-key') => '1111',
        ])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();
    }

    public function testSubmitInvalidEmail()
    {
        $this->post(route('login'), [
            'email' => 'test',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function testSubmitInvalidPassword()
    {
        $password = 'test';

        /**
         * @var User $user
         */
        $user = factory(User::class)->create(['password' => Hash::make($password)]);

        $this->post(route('login'), [
            'email' => $user->email,
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('password')
            ->assertRedirect();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'test2',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function testSubmitValidPassword()
    {
        $password = 'test';

        /**
         * @var User $user
         */
        $user = factory(User::class)->create(['password' => Hash::make($password)]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
