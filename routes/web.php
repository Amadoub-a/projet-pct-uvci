<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\ProfilController;

Route::get('/admin', function () {
    return view('auth.login');
});

Route::post('resete-password', [ProfilController::class, 'resetePassword'])->name('resete-password');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware("auth")->prefix("auth")->name('auth.')->group(function (){
    Route::resource('users', UserController::class);
    Route::get('liste-users', [UserController::class, 'listeUsers'])->name('liste-users');
    
    Route::get('profil', [ProfilController::class, 'profil'])->name('profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('edit-profil');
    Route::get('update-profil/{id}', [ProfilController::class, 'updateProfil'])->name('update-profil');
    Route::put('update-password/{id}', [ProfilController::class, 'updatePassword'])->name('update-password');
}); 

Route::middleware("auth")->prefix("portail")->name('portail.')->group(function (){
    Route::resource('countries', CountryController::class);
    Route::get('liste-countries', [CountryController::class, 'listeCountries'])->name('liste-countries');
});





