<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    // Mengarahkan user ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani callback/response dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
            ->stateless() // ⚠️ penting untuk mencegah state mismatch
            ->user();
            
            // Mencari user berdasarkan email, atau buat baru jika belum ada
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                ]
            );

            // dd($user);
            // 🔐 Bersihkan session sebelum login
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            Auth::login($user);

            request()->session()->regenerate();
            \DB::commit();

            return redirect()->intended(route('dashboard', absolute: false));
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login via Google.');
            // dd($e->getMessage());
        }
    }
}
