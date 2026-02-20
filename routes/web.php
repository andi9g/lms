<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\adminC;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    
    //setting
    Route::get("instansi", [adminC::class, "instansi"]) ->name("instansi");

    // Routes baru menggunakan Volt
    Volt::route('table', 'table-demo')->name('table');
    Volt::route('qa', 'qa-demo')->name('qa');
    Volt::route('auth-demo', 'auth-demo')->name('auth-demo');
});

require __DIR__.'/auth.php';
