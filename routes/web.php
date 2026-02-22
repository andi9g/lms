<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\profilC;
use App\Http\Controllers\adminC;
use App\Http\Controllers\guruC;
use App\Http\Controllers\laporanC;
use Livewire\Volt\Volt;
use App\Http\Middleware\GerbangAdmin;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get("profil", [profilC::class, "profil"])->name("profil")->middleware(['auth', 'verified']);

Route::middleware(['auth'])->group(function () {


    Route::middleware(['admin'])->group(function () {
        //setting admin
        Route::get("instansi", [adminC::class, "instansi"]) ->name("instansi");
        Route::get("semester", [adminC::class, "semester"]) ->name("semester");
        Route::get("masterdata", [adminC::class, "masterdata"]) ->name("masterdata");
        Route::get("account", [adminC::class, "account"])->name("account");
    });

    //guru
    Route::get('absen', [guruC::class, 'absen'])->name('absen');
    Route::get('mapel', [guruC::class, 'mapel'])->name('mapel');
    
    //waka dan admin
    Route::get('laporan', [laporanC::class, 'laporan'])->name('laporan');
    Route::get('laporan/cetak/absen', [laporanC::class, 'cetakabsen'])->name('cetak.absen');

    // Routes baru menggunakan Volt
    Volt::route('table', 'table-demo')->name('table');
    Volt::route('qa', 'qa-demo')->name('qa');
    Volt::route('auth-demo', 'auth-demo')->name('auth-demo');
});

require __DIR__.'/auth.php';
