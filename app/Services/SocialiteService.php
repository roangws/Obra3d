<?php


namespace App\Services;


use App\Helpers\SocialiteHelper;
use App\Services\Contracts\SocialiteServiceInterface;
use App\User;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService implements SocialiteServiceInterface
{
    public function getRedirectUrlByProvider($provider): array
    {
        return [
            'redirectUrl' => Socialite::driver($provider)
                ->stateless()
                ->redirect()
                ->getTargetUrl()
        ];
    }

    public function loginWithSocialite($provider): array
    {
        $driver = $userSocial = Socialite::driver($provider);
        if ($provider == 'facebook') {
            $userSocial = $driver->fields([
                'name', 'first_name', 'last_name', 'email'
            ])->stateless()->user();
        } else if ($provider == 'google') {
            $userSocial = $driver->stateless()->user();
        }

        /* dd($userSocial); */
        if (SocialiteHelper::isSocialPresent($userSocial)) {
            $user = $this->searchUserByEmail($userSocial->email);
            if ($user) {
                return SocialiteHelper::compareUserWithSocialite($user, $userSocial)
                    && $user->createToken()->save()
                    ? $this->prepareSuccessResult($user)
                    : $this->prepareErrorResult();
            } else {

                if ($provider == 'facebook') {
                    $user = new User([], $userSocial);

                    //FIXME  GAMBIARRA
                    $user->name = $userSocial['first_name'];
                    $user->lastname = $userSocial['last_name'];
                    $user->phone = "";
                    $user->markEmailAsVerified();
                } else if ($provider == 'google') {
                    //FIXME  GAMBIARRA
                    $user = new User([], $userSocial);
                    $user->name = $userSocial->user['given_name'];
                    $user->lastname = $userSocial->user['family_name'];
                    $user->phone = "";
                    $user->api_token = $userSocial->token;
                    $user->markEmailAsVerified();
                }

                return $this->prepareRegisterResult($user);


                /* return $user->save()
                ? $this->prepareSuccessResult($user)
                : $this->prepareErrorResult(); */
            }
        } else {
            return $this->prepareErrorResult();
        }
    }

    private function prepareRegisterResult(User $user)
    {
        return $this->makeAuthenticationCookie([
            'api_token' => $user->api_token,
            'user_id' => $user->id,
            'redirect_url' => '/'
        ]);
    }
    private function makeAuthenticationCookie($result)
    {
        $result['cookie'] = cookie(
            'authentication',
            json_encode($result),
            80,
            null,
            null,
            false,
            false
        );
        return $result;
    }

    private function searchUserByEmail($email): ?User
    {
        return User::where('email', $email)
            ->first();
    }

    private function prepareErrorResult(): array
    {
        return $this->makeAuthenticationCookie([
            'error' => 'User is unavailable. Try another social account!',
            'redirect' => '/login',
            'redirect_url' => '/',
        ]);
    }

    private function prepareSuccessResult(User $user): array
    {
        return $this->makeAuthenticationCookie([
            'api_token' => $user->api_token,
            'user_id' => $user->id,
            'redirect_url' => '/'
        ]);
    }
}
