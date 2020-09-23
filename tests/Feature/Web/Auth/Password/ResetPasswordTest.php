<?php

namespace Tests\Feature\Web\Auth\Password;

use App\Models\User;
use App\Validators\ReCaptcha;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testSeeResetFormWithInvalidToken()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = app('auth.password.broker')->createToken($user);

        $this->get(route('password.reset', [$token]))
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function testSubmitInvalidReCaptcha()
    {

        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = app('auth.password.broker')->createToken($user);

        $this->post(route('password.update'), ['email' => 'test@example.com', 'token' => $token])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();

        $this->post(route('password.update'), [
            'email' => 'test@example.com',
            config('recaptcha.validation-key') => '1111',
        ])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();
    }

    public function testSubmitInvalidEmail()
    {
        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        /**
         * @var User $anotherUser
         */
        $anotherUser = factory(User::class)->create();

        $token = app('auth.password.broker')->createToken($user);

        $this->post(route('password.update'), [
            'email' => $anotherUser->email,
            'token' => $token,
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function testSubmitValidEmail()
    {
        /**
         * @var User $user
         */
        $user = factory(User::class)->create();

        $token = app('auth.password.broker')->createToken($user);

        $this->post(route('password.update'), [
            'email' => $user->email,
            'token' => $token,
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
