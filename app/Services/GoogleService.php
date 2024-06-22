<?php

namespace App\Services;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleService
{
    public function login(): void
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::query()->where('email', $googleUser->email)->first();

        if (!$user) {
            $password = \Illuminate\Support\Str::random(8);

            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => \Illuminate\Support\Facades\Hash::make($password),
                'avatar' => $googleUser->avatar,
            ]);

            Mail::to($user['email'])->send(new PasswordMail($password));

            event(new Registered($user));
        }

        $user->update([
            'name' => $googleUser->name,
        ]);

        Auth::login($user);
    }
}
