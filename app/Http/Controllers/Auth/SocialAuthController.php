<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Redirect to the provider’s authentication page
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle the provider callback
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            // Handle errors (e.g., redirect back with an error message)
            return redirect('/login')->withErrors('Unable to login using ' . ucfirst($provider) . '. Please try again.');
        }

        // Find existing user or create new user
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name'     => $socialUser->getName() ?? $socialUser->getNickname(),
                'email'    => $socialUser->getEmail(),
                // Set a random password or consider leaving it null
                'password' => Hash::make(Str::random(24)),
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        return redirect()->route('dashboard'); // Adjust your redirection as needed
    }
}
