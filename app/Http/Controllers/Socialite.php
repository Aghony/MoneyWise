<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect to provider's OAuth page
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from OAuth provider
     */
    public function handleProviderCallback($provider)
    {
        try {
            // Retrieve user from provider
            $socialUser = Socialite::driver($provider)->user();

            // Find or create user
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(str_random(16)), // Random password
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'email_verified_at' => now() // Optional: Auto-verify social login
                ]
            );

            // Login the user
            Auth::login($user);

            // Redirect to dashboard with Inertia
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Handle errors
            return redirect()->route('login')->with([
                'error' => 'Login failed with ' . $provider
            ]);
        }
    }
}