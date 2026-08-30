<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminDepartementController;
use App\Http\Controllers\AdminDemandeController;
use App\Http\Controllers\AdminStageController;

use App\Http\Controllers\Responsable\ResponsableDashboardController;
use App\Http\Controllers\Responsable\ResponsableDemandeController;
use App\Http\Controllers\Responsable\ResponsableHistoriqueController;
use App\Http\Controllers\Responsable\ResponsableStageController;


/*
|--------------------------------------------------------------------------
| ACCUEIL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    LoginController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.submit');

Route::post('/logout', [
    LoginController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| ESPACE ADMINISTRATEUR
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:ADMINISTRATEUR'])
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Tableau de bord
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Utilisateurs
        |--------------------------------------------------------------------------
        */

        Route::get('/utilisateurs', [
            AdminUtilisateurController::class,
            'index'
        ])->name('utilisateurs.index');

        Route::get('/utilisateurs/create', [
            AdminUtilisateurController::class,
            'create'
        ])->name('utilisateurs.create');

        Route::post('/utilisateurs', [
            AdminUtilisateurController::class,
            'store'
        ])->name('utilisateurs.store');

        Route::put('/utilisateurs/{id}/toggle', [
            AdminUtilisateurController::class,
            'toggle'
        ])->name('utilisateurs.toggle');


        /*
        |--------------------------------------------------------------------------
        | Départements
        |--------------------------------------------------------------------------
        */

        Route::get('/departements', [
            AdminDepartementController::class,
            'index'
        ])->name('departements.index');

        Route::get('/departements/create', [
            AdminDepartementController::class,
            'create'
        ])->name('departements.create');

        Route::post('/departements', [
            AdminDepartementController::class,
            'store'
        ])->name('departements.store');

        Route::get('/departements/{id}/edit', [
            AdminDepartementController::class,
            'edit'
        ])->name('departements.edit');

        Route::put('/departements/{id}', [
            AdminDepartementController::class,
            'update'
        ])->name('departements.update');

        Route::delete('/departements/{id}', [
            AdminDepartementController::class,
            'destroy'
        ])->name('departements.destroy');


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        Route::get('/services', [
            AdminServiceController::class,
            'index'
        ])->name('services.index');

        Route::get('/services/create', [
            AdminServiceController::class,
            'create'
        ])->name('services.create');

        Route::post('/services', [
            AdminServiceController::class,
            'store'
        ])->name('services.store');

        Route::get('/services/{id}/edit', [
            AdminServiceController::class,
            'edit'
        ])->name('services.edit');

        Route::put('/services/{id}', [
            AdminServiceController::class,
            'update'
        ])->name('services.update');

        Route::delete('/services/{id}', [
            AdminServiceController::class,
            'destroy'
        ])->name('services.destroy');


        /*
        |--------------------------------------------------------------------------
        | Demandes de stage
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            AdminDemandeController::class,
            'index'
        ])->name('demandes.index');

        Route::get('/demandes/{id}', [
            AdminDemandeController::class,
            'show'
        ])->name('demandes.show');


        /*
        |--------------------------------------------------------------------------
        | Stages
        |--------------------------------------------------------------------------
        */

        Route::get('/stages', [
            AdminStageController::class,
            'index'
        ])->name('stages.index');

        Route::get('/stages/{idDemande}', [
            AdminStageController::class,
            'show'
        ])->name('stages.show');

    });


/*
|--------------------------------------------------------------------------
| ESPACE RESPONSABLE / AGENT
|--------------------------------------------------------------------------
*/

Route::prefix('responsable')
    ->name('responsable.')
    ->middleware(['auth', 'role:RESPONSABLE,AGENT'])
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Tableau de bord
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            ResponsableDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Demandes
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            ResponsableDemandeController::class,
            'index'
        ])->name('demandes.index');

        Route::get('/demandes/create', [
            ResponsableDemandeController::class,
            'create'
        ])->name('demandes.create');

        Route::post('/demandes', [
            ResponsableDemandeController::class,
            'store'
        ])->name('demandes.store');

        Route::get('/demandes/{id}', [
            ResponsableDemandeController::class,
            'show'
        ])->name('demandes.show');

        Route::post('/demandes/{id}/accepter', [
            ResponsableDemandeController::class,
            'accepter'
        ])->name('demandes.accepter');

        Route::post('/demandes/{id}/refuser', [
            ResponsableDemandeController::class,
            'refuser'
        ])->name('demandes.refuser');

        Route::post('/demandes/{id}/demander-infos', [
            ResponsableDemandeController::class,
            'demanderInfos'
        ])->name('demandes.demander-infos');

        Route::post('/demandes/{id}/affecter', [
            ResponsableDemandeController::class,
            'affecter'
        ])->name('demandes.affecter');

        Route::post('/demandes/{id}/documents', [
            ResponsableDemandeController::class,
            'storeDocument'
        ])->name('demandes.documents.store');


        /*
        |--------------------------------------------------------------------------
        | Stages
        |--------------------------------------------------------------------------
        */

        Route::get('/stages', [
            ResponsableStageController::class,
            'index'
        ])->name('stages.index');


        /*
        |--------------------------------------------------------------------------
        | Historique
        |--------------------------------------------------------------------------
        */

        Route::get('/historique', [
            ResponsableHistoriqueController::class,
            'index'
        ])->name('historique.index');

    });