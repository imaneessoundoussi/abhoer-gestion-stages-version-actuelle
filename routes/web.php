<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EtudiantDashboardController;
use App\Http\Controllers\EtudiantProfilController;
use App\Http\Controllers\EtudiantDemandeStageController;


/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

// Afficher la page de connexion
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

// Traiter la connexion
Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

// Déconnexion
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Administration
|--------------------------------------------------------------------------
*/

// Dashboard administrateur
Route::get(
    '/admin/dashboard',
    [AdminDashboardController::class, 'index']
)->name('admin.dashboard');

// Liste des utilisateurs
Route::get(
    '/admin/utilisateurs',
    [AdminUtilisateurController::class, 'index']
)->name('admin.utilisateurs.index');

// Formulaire de création d'utilisateur
Route::get(
    '/admin/utilisateurs/create',
    [AdminUtilisateurController::class, 'create']
)->name('admin.utilisateurs.create');

// Enregistrer un utilisateur
Route::post(
    '/admin/utilisateurs',
    [AdminUtilisateurController::class, 'store']
)->name('admin.utilisateurs.store');

// Activer / désactiver un utilisateur
Route::put(
    '/admin/utilisateurs/{id}/toggle',
    [AdminUtilisateurController::class, 'toggle']
)->name('admin.utilisateurs.toggle');


/*
|--------------------------------------------------------------------------
| Inscription étudiant
|--------------------------------------------------------------------------
*/

// Afficher le formulaire d'inscription
Route::get(
    '/inscription',
    [InscriptionController::class, 'showForm']
)->name('inscription');

// Enregistrer l'inscription
Route::post(
    '/inscription',
    [InscriptionController::class, 'register']
)->name('inscription.register');


/*
|--------------------------------------------------------------------------
| Espace étudiant
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard étudiant
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/etudiant/dashboard',
        [EtudiantDashboardController::class, 'index']
    )->name('etudiant.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Profil étudiant
    |--------------------------------------------------------------------------
    */

    // Afficher le profil
    Route::get(
        '/etudiant/profil',
        [EtudiantProfilController::class, 'index']
    )->name('etudiant.profil');

    // Afficher le formulaire de modification
    Route::get(
        '/etudiant/profil/modifier',
        [EtudiantProfilController::class, 'edit']
    )->name('etudiant.profil.edit');

    // Enregistrer les modifications
    Route::put(
        '/etudiant/profil',
        [EtudiantProfilController::class, 'update']
    )->name('etudiant.profil.update');


    /*
    |--------------------------------------------------------------------------
    | DEMANDES DE STAGE
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Liste des demandes de l'étudiant
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/etudiant/demandes',
        [EtudiantDemandeStageController::class, 'index']
    )->name('etudiant.demande.index');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 1
    | Afficher le formulaire de nouvelle demande
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/etudiant/demande-stage/nouvelle',
        [EtudiantDemandeStageController::class, 'create']
    )->name('etudiant.demande.create');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 1
    | Enregistrer les informations de la demande
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/etudiant/demande-stage',
        [EtudiantDemandeStageController::class, 'store']
    )->name('etudiant.demande.store');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 2
    | Afficher le formulaire des documents
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/etudiant/demande-stage/{idDemande}/documents',
        [EtudiantDemandeStageController::class, 'documents']
    )->name('etudiant.demande.documents');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 2
    | Enregistrer les documents
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/etudiant/demande-stage/{idDemande}/documents',
        [EtudiantDemandeStageController::class, 'storeDocuments']
    )->name('etudiant.demande.documents.store');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 3
    | Afficher la page de confirmation
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/etudiant/demande-stage/{idDemande}/confirmation',
        [EtudiantDemandeStageController::class, 'confirmation']
    )->name('etudiant.demande.confirmation');


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 3
    | Confirmer définitivement la demande
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/etudiant/demande-stage/{idDemande}/confirmer',
        [EtudiantDemandeStageController::class, 'confirmer']
    )->name('etudiant.demande.confirmer');

});