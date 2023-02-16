<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where([
                'provider_id' => $socialUser->id,
                'provider' => $provider
            ])->first();
            if (!$user) {
                if (User::where('email', $socialUser->getEmail())->exists()) {
                    return redirect('/login')->withErrors(['email' => "This email uses different method to login"]);
                }
                $password =Str::random(12);
                $user = User::create([
                    'name' => $socialUser->name? $socialUser->name : $socialUser->nickname,
                    'username' => User::generateUserName($socialUser->nickname),
                    'email' => $socialUser->email,
                    'provider_token' => $socialUser->token,
                    'provider_id' => $socialUser->id,
                    'provider'=>$provider,
                    'password'=>$password
                ]);
                $user->sendEmailVerificationNotification();
                $user->update([
                    'password'=>Hash::make($password)
                ]);
            }
            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e ) {
           return redirect('/login');
        }


    // $user->token
    }
}
