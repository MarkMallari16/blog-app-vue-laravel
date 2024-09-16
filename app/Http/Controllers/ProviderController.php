<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $githubUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'provider_id' => $githubUser->id,
        ], [
            'avatar' => $githubUser->avatar,
            'name' => $githubUser->name, 
            'email' => $githubUser->email,
            'provider_token' => $githubUser->token,
            'provider_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);
       
        // dd($user);

        return redirect('/dashboard');
    }
}
