<?php

namespace Tests\Feature\Web\Auth;

use App\Models\User;
use App\Validators\ReCaptcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testSeeLoginForm()
    {
        $this->get(route('register'))->assertOk();
    }

    public function testSubmitInvalidReCaptcha()
    {
        $this->post(route('register'), ['email' => 'test@example.com'])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();

        $this->post(route('register'), [
            'email' => 'test@example.com',
            config('recaptcha.validation-key') => '1111',
        ])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();
    }

    public function testSubmitInvalidEmail()
    {
        $this->post(route('register'), [
            'email' => 'test',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function testSubmitMissMatchedPassword()
    {
        $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'password' => 'testtest',
            'password_confirmation' => 'testtest2',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('password')
            ->assertRedirect();
    }

    public function testRegisterUser()
    {
        Event::fake();

        /**
         * @var User $user
         */
        $user = User::factory()->make();

        $this->post(route('register'), [
            'email' => $user->email,
            'name' => $user->name,
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $this->assertDatabaseHas($user->getTable(), ['email' => $user->email]);

        Event::assertDispatched(Registered::class);
    }
}
