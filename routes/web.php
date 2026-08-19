<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\Responsable\ResponsableDashboardController;
use App\Http\Controllers\Responsable\ResponsableDemandeController;
use App\Http\Controllers\Responsable\ResponsableHistoriqueController;
use App\Http\Controllers\Responsable\ResponsableStageController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/utilisateurs', [AdminUtilisateurController::class, 'index'])
    ->name('admin.utilisateurs.index');

Route::get('/admin/utilisateurs/create', [AdminUtilisateurController::class, 'create'])
    ->name('admin.utilisateurs.create');

Route::post('/admin/utilisateurs', [AdminUtilisateurController::class, 'store'])
    ->name('admin.utilisateurs.store');

Route::put('/admin/utilisateurs/{id}/toggle', [AdminUtilisateurController::class, 'toggle'])
    ->name('admin.utilisateurs.toggle');

/*
|--------------------------------------------------------------------------
| Espace Responsable (fusionné avec l'espace Agent)
|--------------------------------------------------------------------------
*/
Route::prefix('responsable')
    ->name('responsable.')
    ->middleware(['auth', 'role:RESPONSABLE,AGENT'])
    ->group(function () {

        Route::get('/dashboard', [ResponsableDashboardController::class, 'index'])
            ->name('dashboard');

        // Liste des demandes (recherche, filtres)
        Route::get('/demandes', [ResponsableDemandeController::class, 'index'])
            ->name('demandes.index');

        // Enregistrement d'une demande déposée physiquement au bureau (tâche Agent)
        Route::get('/demandes/create', [ResponsableDemandeController::class, 'create'])
            ->name('demandes.create');
        Route::post('/demandes', [ResponsableDemandeController::class, 'store'])
            ->name('demandes.store');

        // Détail d'une demande
        Route::get('/demandes/{id}', [ResponsableDemandeController::class, 'show'])
            ->name('demandes.show');

        // Actions de traitement
        Route::post('/demandes/{id}/accepter', [ResponsableDemandeController::class, 'accepter'])
            ->name('demandes.accepter');
        Route::post('/demandes/{id}/refuser', [ResponsableDemandeController::class, 'refuser'])
            ->name('demandes.refuser');
        Route::post('/demandes/{id}/demander-infos', [ResponsableDemandeController::class, 'demanderInfos'])
            ->name('demandes.demander-infos');
        Route::post('/demandes/{id}/affecter', [ResponsableDemandeController::class, 'affecter'])
            ->name('demandes.affecter');

        // Ajout de documents à une demande existante (tâche Agent)
        Route::post('/demandes/{id}/documents', [ResponsableDemandeController::class, 'storeDocument'])
            ->name('demandes.documents.store');

        // Suivi des stages (à venir, en cours, terminés)
        Route::get('/stages', [ResponsableStageController::class, 'index'])
            ->name('stages.index');

        // Historique complet des actions
        Route::get('/historique', [ResponsableHistoriqueController::class, 'index'])
            ->name('historique.index');
    });