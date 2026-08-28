<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\EtudiantDashboardController;
use App\Http\Controllers\EtudiantDemandeStageController;
use App\Http\Controllers\EtudiantProfilController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;

/*
|--------------------------------------------------------------------------
| Page d'accueil
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    LoginController::class,
    'showLoginForm'
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.submit');

Route::post('/logout', [
    LoginController::class,
    'logout'
])->name('logout');

Route::get('/inscription', [
    InscriptionController::class,
    'showRegistrationForm'
])->name('inscription');

Route::post('/inscription', [
    InscriptionController::class,
    'register'
])->name('inscription.store');


/*
|--------------------------------------------------------------------------
| ESPACE ÉTUDIANT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:ETUDIANT'])
    ->prefix('etudiant')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Tableau de bord
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            EtudiantDashboardController::class,
            'index'
        ])->name('etudiant.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Demandes de stage
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            EtudiantDemandeStageController::class,
            'index'
        ])->name('etudiant.demandes.index');

        Route::get('/demandes/nouvelle', [
            EtudiantDemandeStageController::class,
            'create'
        ])->name('etudiant.demandes.create');


        /*
        |--------------------------------------------------------------------------
        | Étape 1 : informations
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'informations'
        ])->name('etudiant.demandes.informations');

        Route::post('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'storeInformations'
        ])->name('etudiant.demandes.informations.store');


        /*
        |--------------------------------------------------------------------------
        | Demande spécifique
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'show'
        ])->name('etudiant.demandes.show');


        /*
        |--------------------------------------------------------------------------
        | Étape 2 : documents d'une demande
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}/documents', [
            EtudiantDemandeStageController::class,
            'documents'
        ])->name('etudiant.demandes.documents');

        Route::post('/demandes/{idDemande}/documents', [
            EtudiantDemandeStageController::class,
            'storeDocuments'
        ])->name('etudiant.demandes.documents.store');


        /*
        |--------------------------------------------------------------------------
        | Voir un document
        |--------------------------------------------------------------------------
        |
        | Ouvre le document dans le navigateur.
        |
        */

        Route::get('/demandes/{idDemande}/documents/{idDocument}/voir', [
            EtudiantDemandeStageController::class,
            'voirDocument'
        ])->name('etudiant.documents.voir');


        /*
        |--------------------------------------------------------------------------
        | Télécharger un document
        |--------------------------------------------------------------------------
        |
        | Permet également de télécharger le document.
        |
        */

        Route::get('/demandes/{idDemande}/documents/{idDocument}/telecharger', [
            EtudiantDemandeStageController::class,
            'telechargerDocument'
        ])->name('etudiant.documents.telecharger');


        /*
        |--------------------------------------------------------------------------
        | Supprimer un document
        |--------------------------------------------------------------------------
        |
        | Supprime le fichier physique + l'enregistrement
        | dans la base de données.
        |
        */

        Route::delete('/demandes/{idDemande}/documents/{idDocument}', [
            EtudiantDemandeStageController::class,
            'destroyDocument'
        ])->name('etudiant.documents.destroy');


        /*
        |--------------------------------------------------------------------------
        | Étape 3 : confirmation
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}/confirmation', [
            EtudiantDemandeStageController::class,
            'confirmation'
        ])->name('etudiant.demandes.confirmation');

        Route::post('/demandes/{idDemande}/confirmer', [
            EtudiantDemandeStageController::class,
            'confirmer'
        ])->name('etudiant.demandes.confirmer');


        /*
        |--------------------------------------------------------------------------
        | Supprimer une demande complète
        |--------------------------------------------------------------------------
        |
        | Cette route supprime :
        | - la demande
        | - tous ses documents en base
        | - tous les fichiers physiques
        |
        */

        Route::delete('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'destroy'
        ])->name('etudiant.demandes.destroy');


        /*
        |--------------------------------------------------------------------------
        | Mes documents
        |--------------------------------------------------------------------------
        */

        Route::get('/documents', [
            EtudiantDemandeStageController::class,
            'documentsIndex'
        ])->name('etudiant.documents.index');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        Route::get('/notifications', function () {
            return view('etudiant.notifications');
        })->name('etudiant.notifications');


        /*
        |--------------------------------------------------------------------------
        | Profil
        |--------------------------------------------------------------------------
        */

        Route::get('/profil', [
            EtudiantProfilController::class,
            'index'
        ])->name('etudiant.profil');

        Route::get('/profil/modifier', [
            EtudiantProfilController::class,
            'edit'
        ])->name('etudiant.profil.edit');

        Route::put('/profil', [
            EtudiantProfilController::class,
            'update'
        ])->name('etudiant.profil.update');
    });


/*
|--------------------------------------------------------------------------
| ESPACE ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:ADMIN'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Tableau de bord
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Utilisateurs
        |--------------------------------------------------------------------------
        */

        Route::get('/utilisateurs', [
            AdminUtilisateurController::class,
            'index'
        ])->name('admin.utilisateurs.index');

        Route::get('/utilisateurs/create', [
            AdminUtilisateurController::class,
            'create'
        ])->name('admin.utilisateurs.create');

        Route::post('/utilisateurs', [
            AdminUtilisateurController::class,
            'store'
        ])->name('admin.utilisateurs.store');

        Route::get('/utilisateurs/{idUtilisateur}/edit', [
            AdminUtilisateurController::class,
            'edit'
        ])->name('admin.utilisateurs.edit');

        Route::put('/utilisateurs/{idUtilisateur}', [
            AdminUtilisateurController::class,
            'update'
        ])->name('admin.utilisateurs.update');

        Route::delete('/utilisateurs/{idUtilisateur}', [
            AdminUtilisateurController::class,
            'destroy'
        ])->name('admin.utilisateurs.destroy');

        Route::patch('/utilisateurs/{idUtilisateur}/toggle', [
            AdminUtilisateurController::class,
            'toggle'
        ])->name('admin.utilisateurs.toggle');
    });
