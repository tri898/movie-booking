<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Implement redirect provider
     *
     * @param string $provider
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(string $provider): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Implement callback provider
     *
     * @param string $provider
     * @return RedirectResponse
     */
    public function providerCallback(string $provider): RedirectResponse
    {
        try {
            $socialInfo = Socialite::driver($provider)->user();
            $socialUser = $this->userRepository->findByProvider($provider, $socialInfo->getId());

            if ($socialUser) {
                Auth::login($socialUser->user);
                return redirect()->route('home');
            }
            $user = $this->userRepository->findByEmail($socialInfo->getEmail());
            if (!$user) {
                $user = $this->userRepository->store([
                    'email' => $socialInfo->getEmail(),
                    'name' => $socialInfo->getName()
                ]);
            }
            $this->userRepository->storeProviderUser($user, $provider, $socialInfo->getId());
            Auth::login($user);
            return redirect()->route('home');

        } catch (Exception $e) {
            Log::error('Social login:', ['error' => $e->getMessage()]);
            return redirect()->route('auth.login');
        }
    }
}
