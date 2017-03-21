<?php

namespace App\Http\Controllers;

use App\Helpers\SocialAccountHelper;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialAuthController
 * @package App\Http\Controllers
 */
class SocialAuthController extends Controller
{
    /**
     * @return mixed
     */
    public function redirect() {
        return Socialite::driver('facebook')->scopes(['user_posts'])->redirect();
    }

    public function callback(SocialAccountHelper $helper, Request $request) {
        $fbUser = Socialite::driver('facebook')->stateless()->user();
        $user = $helper->createOrGetUser($fbUser);

        Auth::login($user, true);
        $request->session()->push('fb_token', $fbUser->token);

        return redirect()->route('home');
    }
}
