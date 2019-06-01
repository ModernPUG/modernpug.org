<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Email;
use Socialite;
use App\OauthIdentity;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {

        /**
         * @var \Laravel\Socialite\Contracts\User
         */
        $provider_user = Socialite::with($provider)->user();

        $oauth_identity = OauthIdentity::firstOrNew([
            'provider' => $provider,
            'provider_user_id' => $provider_user->id,
        ]);

        $email = Email::firstOrNew(['email' => $provider_user->getEmail()]);

        if ($oauth_identity->user_id) {
            $user = User::find($oauth_identity->user_id);
        } else {
            $user = User::firstOrNew(['email' => $provider_user->getEmail()]);
        }

        $oauth_identity->access_token = $provider_user->token;

        if (! $user->id) {
            $user->name = $provider_user->getName();
            $email->is_primary = 1;
        }

        $user->avatar_url = $user->avatar_url ?: $provider_user->getAvatar();

        $user->save();
        $user->emails()->save($email);
        $user->oauth_identities()->save($oauth_identity);

        auth()->login($user, true);

        return redirect(route('home'));
    }
}
