<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfilController;
use App\Http\Controllers\Parametre\NationController;

Route::get('/', function () {
    return view('site.index');
});

Route::get('/admin', function () {
    return view('auth.login');
});

Route::get('/confirm-compte', function () {
    return view('auth.passwords.confirm');
});

Route::post('definir-password', [LoginController::class, 'definirPassword'])->name('definir-password');
Route::post('resete-password', [ProfilController::class, 'resetePassword'])->name('resete-password');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/superviseur', 'HomeController@superviseur')->name('superviseur');

Route::middleware("auth")->prefix("auth")->name('auth.')->group(function (){
    Route::resource('users', UserController::class);
    Route::get('liste-users', [UserController::class, 'listeUsers'])->name('liste-users');
    
    Route::get('profil', [ProfilController::class, 'profil'])->name('profil');
    Route::get('edit-profil', [ProfilController::class, 'edit'])->name('edit-profil');
    Route::get('update-profil/{id}', [ProfilController::class, 'updateProfil'])->name('update-profil');
    Route::put('update-password/{id}', [ProfilController::class, 'updatePassword'])->name('update-password');
}); 


Route::middleware("auth")->prefix("parametre")->name('parametre.')->group(function (){
   
    Route::resource('nations', NationController::class);
    Route::get('liste-nations', [NationController::class, 'listeNations'])->name('liste-nations');

    
});  




