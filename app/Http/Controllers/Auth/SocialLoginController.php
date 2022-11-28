<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, SocialUser};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Implement redirect provider
     *
     * @param string $provider
     * @return void
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Implement callback provider
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function providerCallback(string $provider): \Illuminate\Http\RedirectResponse
    {
        try {
            $socialInfo = Socialite::driver($provider)->user();
            $socialUser = SocialUser::where([
                'provider_name' => $provider,
                'provider_id' => $socialInfo->getId()
            ])->first();

            if ($socialUser) {
                Auth::login($socialUser->user);
                return redirect()->route('home');
            }
            $user = User::where(['email' => $socialInfo->getEmail()])->first();
            if (!$user) {
                $user = User::create([
                    'email' => $socialInfo->getEmail(),
                    'name' => $socialInfo->getName()
                ]);
            }
            $user->socialUsers()->create([
                'provider_name' => $provider,
                'provider_id' => $socialInfo->getAvatar()
            ]);
            Auth::login($user);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Log::error('Social login:', ['error' => $th->getMessage()]);
            return redirect()->route('auth.login');
        }
    }
}
