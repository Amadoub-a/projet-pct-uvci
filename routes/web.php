<?php

use App\Http\Middleware\IsClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CinetPayController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CopieActeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeClientController;
use App\Http\Controllers\Auth\ProfilController;
use App\Http\Controllers\LegalisationController;
use App\Http\Controllers\CertificatVieController;
use App\Http\Controllers\DeclarationDeceController;
use App\Http\Controllers\Parametre\NationController;
use App\Http\Controllers\Parametre\CommuneController;
use App\Http\Controllers\DeclarationMariageController;
use App\Http\Controllers\DeclarationNaissanceController;
use App\Http\Controllers\TraitementController;
use App\Models\DeclarationNaissance;

Route::get('/', function () {
    return view('site.index');
});

Route::get('services', [SiteController::class, 'services'])->name('services');
Route::get('declaration-naissance', [SiteController::class, 'declarationNaissance'])->name('declaration-naissance');
Route::get('declaration-mariage', [SiteController::class, 'declarationMariage'])->name('declaration-mariage');
Route::get('declaration-deces', [SiteController::class, 'declarationDeces'])->name('declaration-deces');
Route::get('declaration-vie', [SiteController::class, 'declarationVie'])->name('declaration-vie');
Route::get('legalisation-document', [SiteController::class, 'legalisationDocument'])->name('legalisation-document');
Route::get('copie-acte', [SiteController::class, 'copieActe'])->name('copie-acte');

Route::get('tarifs', [SiteController::class, 'tarifs'])->name('tarifs');
Route::get('about', [SiteController::class, 'about'])->name('about');
Route::get('contact', [SiteController::class, 'contact'])->name('contact');
Route::get('se-connecter', [SiteController::class, 'signIn'])->name('sign-in');
Route::get('cree-compte', [SiteController::class, 'signUp'])->name('sign-up');

Route::get('client-password-request', [SiteController::class, 'clientPasswordRequest'])->name('client-password-request');
Route::post('reset-password', [SiteController::class, 'resetPassword'])->name('reset-password');

Route::get('client-definir-password', [SiteController::class, 'definirPassword'])->name("client-definir-password");
Route::post('redefnir-password', [SiteController::class, 'redefnirPassword'])->name('redefnir-password');

Route::post('inscription', [SiteController::class, 'inscription'])->name('inscription');
Route::post('connexion', [SiteController::class, 'connexion'])->name('connexion');

Route::get('/admin', function () {
    return view('auth.login');
});

Route::get('/confirm-compte', function () {
    return view('auth.passwords.confirm');
});

Route::post('definir-password', [LoginController::class, 'definirPassword'])->name('definir-password');
Route::post('resete-password', [ProfilController::class, 'resetePassword'])->name('resete-password');

Auth::routes();
Route::middleware([IsClient::class])->group(function () {
    Route::get('/client-home', [HomeClientController::class, 'clientHome'])->name('client-home');
    Route::get('/mon-profil', [HomeClientController::class, 'monProfil'])->name('mon-profil');
    Route::post('/modifier-profile', [HomeClientController::class, 'modifierProfile'])->name('modifier-profile');
    Route::post('/modifier-password', [HomeClientController::class, 'modifierPassword'])->name('modifier-password');
    Route::post('/client-logout', [SiteController::class, 'clientLogout'])->name('client-logout');

    Route::post('/send-declaration-naissance', [DeclarationNaissanceController::class, 'storeDeclarationNaissance'])->name('send-declaration-naissance');
    Route::post('/store-declaration-mariage', [DeclarationMariageController::class, 'storeDeclarationMariage'])->name('store-declaration-mariage');
    Route::post('/store-declaration-deces', [DeclarationDeceController::class, 'storeDeclarationDeces'])->name('store-declaration-deces');
    Route::post('/store-legalisation', [LegalisationController::class, 'storeLegalisation'])->name('store-legalisation');
    Route::post('/store-copie-acte', [CopieActeController::class, 'storeCopieActe'])->name('store-copie-acte');
    
    Route::get('/choix-payement', [PayementController::class, 'choixPayement'])->name('choix-payement');
    Route::post('/payment-success', [PayementController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment-failed', [PayementController::class, 'paymentFailed'])->name('payment.failed');

    Route::get('liste-demandes-cours', [TraitementController::class, 'listeDemandesCours'])->name('liste-demandes-cours');
    Route::get('liste-demandes-traitees', [TraitementController::class, 'listeDemandesTraitees'])->name('liste-demandes-traitees');
});

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

Route::middleware("auth")->prefix("back")->name('back.')->group(function (){
    Route::get('liste-nouvelle-demandes', [TraitementController::class, 'listeNouvelleDemandes'])->name('liste-nouvelle-demandes');

    Route::get('liste-declarations-naissances', [DeclarationNaissanceController::class, 'listeDeclarationsNaissances'])->name('liste-declarations-naissances');
    Route::get('liste-declarations-mariage', [DeclarationMariageController::class, 'listeDeclarationsMariages'])->name('liste-declarations-mariage');
    Route::get('liste-declarations-deces', [DeclarationDeceController::class, 'listeDeclarationsDeces'])->name('liste-declarations-deces');
    Route::get('liste-legalisations', [LegalisationController::class, 'listeLegalisations'])->name('liste-legalisations');
    Route::get('liste-copies-actes', [CopieActeController::class, 'listeCopiesActes'])->name('liste-copies-actes');

    Route::get('vue-declarations-naissances', [DeclarationNaissanceController::class, 'vueDeclarationsNaissances'])->name('vue-declarations-naissances');
    Route::get('vue-declarations-mariage', [DeclarationMariageController::class, 'vueDeclarationsMariages'])->name('vue-declarations-mariage');
    Route::get('vue-declarations-deces', [DeclarationDeceController::class, 'vueDeclarationsDeces'])->name('vue-declarations-deces');
    Route::get('vue-legalisations', [LegalisationController::class, 'vueLegalisations'])->name('vue-legalisations');
    Route::get('vue-copies-actes', [CopieActeController::class, 'vueCopiesActes'])->name('vue-copies-actes');

    Route::post('naissance/update', [DeclarationNaissanceController::class, 'updateNaissance'])->name('naissance.update');
    Route::get('document-valides/acte-naissance', [DeclarationNaissanceController::class, 'acteNaissance'])->name('acte-naissances');
    Route::get('liste-acte-naissances', [DeclarationNaissanceController::class, 'listeActeNaissances'])->name('liste-acte-naissances');
    Route::get('print-acte-naissance/{id_acte}', [DeclarationNaissanceController::class, 'printActeNaissance']);
    Route::post('signer-acte-naissance', [DeclarationNaissanceController::class, 'signerActeNaissance'])->name('signer-acte-naissance');

});

Route::middleware("auth")->prefix("parametre")->name('parametre.')->group(function (){
    Route::resource('nations', NationController::class);
    Route::get('liste-nations', [NationController::class, 'listeNations'])->name('liste-nations');

    Route::resource('communes', CommuneController::class);
    Route::get('liste-communes', [CommuneController::class, 'listeCommunes'])->name('liste-communes');
});




