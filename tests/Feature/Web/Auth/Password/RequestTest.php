<?php

namespace Tests\Feature\Web\Auth\Password;

use App\User;
use App\Validators\ReCaptcha;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RequestTest extends TestCase
{

    use DatabaseTransactions;

    public function testSeeResetPasswordRequestForm()
    {
        $this->get(route('password.request'))->assertOk();
    }


    public function testResetPasswordWithoutCaptcha()
    {
        $this->post(route('password.email'),['email'=>'test@example.com'])
            ->assertSessionHasErrors(config('recaptcha.validation-key'))
            ->assertRedirect();
    }

    /**
     * 정상 이메일 발송은 라라벨에서 검증이 완료된 것으로 가정하고 테스트하지 않는다.
     */
    public function testRequestResetPasswordWithNotExistsEmail()
    {
        $this->post(route('password.email'),[
            'email'=>'test',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->post(route('password.email'),[
            'email'=>'test@example.com',
            config('recaptcha.validation-key') => ReCaptcha::ACCEPT_TEST_KEY,
        ])
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }


}
