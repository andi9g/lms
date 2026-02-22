<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\fotoprofilM;
use App\Models\semesterM;
use App\Models\posisiM;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Session;

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
            
            $posisi = "guru";
            $status = false;
            if(User::count() == 0) {
                $posisi = "admin";
                $status = true;
            }

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                ]
            );

            fotoprofilM::firstOrCreate([
                "iduser" => $user->iduser,
            ],[
                "fotoprofil" => $googleUser->getAvatar(),
            ]);

            posisiM::firstOrCreate([
                "iduser" => $user->iduser,
            ],[
                "posisi" => $posisi,
                "status" => $status,
            ]);

            // dd($user);
            // 🔐 Bersihkan session sebelum login
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            $semester = semesterM::class;
            if($semester::count()>0) {
                $semester = $semester::orderBy("idsemester", "desc")->first();
                Session::put("idsemester", $semester->idsemester);
            }

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
