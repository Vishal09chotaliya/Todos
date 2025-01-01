<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function githubLogin()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            // Example: Fetch or create the user in your database
            $user = User::firstOrCreate(
                ['email' => $githubUser->getEmail()],
                [
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'github_id' => $githubUser->getId(),
                    'password' => bcrypt('123456'),
                ]
            );

            // Log in the user
            Auth::login($user);

            return redirect()->route('dashbord'); // Redirect to a home or dashboard page
        } catch (\Exception $e) {
            return redirect()->route('welcome')->withErrors(['error' => 'Unable to login with GitHub.']);
        }
    }
}
