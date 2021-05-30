<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\OauthIdentity;
use App\Models\User;
use App\Services\User\Exceptions\AccessDeniedUserException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Slack\Provider;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('recaptcha')->only('login');
    }

    /**
     * Validate the user login request.
     *
     * @param  Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|email',
            'password' => 'required|string',
        ]);
    }

    /**
     * @param $driver
     * @return RedirectResponse
     */
    public function redirectToProvider($driver): RedirectResponse
    {
        /**
         * @var Provider $provider
         */
        $provider = Socialite::driver($driver);
        if ($driver === 'slack') {
            $provider->with(['team' => config('services.slack.team')]);
        }
        return $provider->redirect();

    }

    /**
     * @param $provider
     * @return Application|\Illuminate\Http\RedirectResponse|Response|Redirector
     */
    public function handleProviderCallback($provider)
    {
        /**
         * @var \Laravel\Socialite\Contracts\User
         */
        $providerUser = Socialite::with($provider)->user();

        $oauthIdentity = OauthIdentity::firstOrNew([
            'provider' => $provider,
            'provider_user_id' => $providerUser->id,
        ]);

        $email = Email::firstOrNew(['email' => $providerUser->getEmail()]);

        if ($oauthIdentity->user_id) {
            $user = User::withTrashed()->find($oauthIdentity->user_id);
        } else {
            $user = User::withTrashed()->firstOrNew(['email' => $providerUser->getEmail()]);
        }

        $oauthIdentity->access_token = $providerUser->token;

        if (! $user->id) {
            $user->name = $providerUser->getName();
            $email->is_primary = 1;
        }

        $user->avatar_url = $user->avatar_url ?: $providerUser->getAvatar();

        $user->save();
        $user->emails()->save($email);
        $user->oauth_identities()->save($oauthIdentity);

        if ($user->deleted_at) {
            throw new AccessDeniedUserException('탈퇴 처리된 회원입니다');
        }
        auth()->login($user, true);

        return redirect(route('home'));
    }
}
