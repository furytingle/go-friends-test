<?php
/**
 * Created by PhpStorm.
 * User: azhylinskiy-developer
 * Date: 21.03.17
 * Time: 12:13
 */

namespace App\Helpers;

use App\SocialAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

/**
 * Class SocialAccountHelper
 * @package app\Helpers
 */
class SocialAccountHelper
{
    /**
     * Facebook driver name
     */
    const FACEBOOK_PROVIDER = 'facebook';

    /**
     * @param ProviderUser $providerUser
     * @return mixed
     */
    public function createOrGetUser(ProviderUser $providerUser) {
        $account = SocialAccount::whereProvider(self::FACEBOOK_PROVIDER)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if (!$account) {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => self::FACEBOOK_PROVIDER
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => bcrypt(str_random(6))
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }

        return $account->user;
    }
}