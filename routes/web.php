<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InscriptionController;

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUtilisateurController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminDepartementController;
use App\Http\Controllers\AdminDemandeController;
use App\Http\Controllers\AdminStageController;

/*
|--------------------------------------------------------------------------
| RESPONSABLE / AGENT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Responsable\ResponsableDashboardController;
use App\Http\Controllers\Responsable\ResponsableDemandeController;
use App\Http\Controllers\Responsable\ResponsableHistoriqueController;
use App\Http\Controllers\Responsable\ResponsableStageController;

/*
|--------------------------------------------------------------------------
| ETUDIANT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\EtudiantDashboardController;
use App\Http\Controllers\EtudiantDemandeStageController;
use App\Http\Controllers\EtudiantProfilController;


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


/*
|--------------------------------------------------------------------------
| INSCRIPTION
|--------------------------------------------------------------------------
*/

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
| ESPACE ETUDIANT
|--------------------------------------------------------------------------
*/

Route::prefix('etudiant')
    ->name('etudiant.')
    ->middleware(['auth', 'role:ETUDIANT'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Tableau de bord
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            EtudiantDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Demandes de stage
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes', [
            EtudiantDemandeStageController::class,
            'index'
        ])->name('demandes.index');

        Route::get('/demandes/nouvelle', [
            EtudiantDemandeStageController::class,
            'create'
        ])->name('demandes.create');


        /*
        |--------------------------------------------------------------------------
        | Etape 1 : informations
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'informations'
        ])->name('demandes.informations');

        Route::post('/demandes/informations', [
            EtudiantDemandeStageController::class,
            'storeInformations'
        ])->name('demandes.informations.store');


        /*
        |--------------------------------------------------------------------------
        | Demande spécifique
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'show'
        ])->name('demandes.show');


        /*
        |--------------------------------------------------------------------------
        | Documents d'une demande
        |--------------------------------------------------------------------------
        */

        Route::get('/demandes/{idDemande}/documents', [
            EtudiantDemandeStageController::class,
            'documents'
        ])->name('demandes.documents');

        Route::post('/demandes/{idDemande}/documents', [
            EtudiantDemandeStageController::class,
            'storeDocuments'
        ])->name('demandes.documents.store');


        /*
        |--------------------------------------------------------------------------
        | Voir un document
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/demandes/{idDemande}/documents/{idDocument}/voir',
            [
                EtudiantDemandeStageController::class,
                'voirDocument'
            ]
        )->name('documents.voir');


        /*
        |--------------------------------------------------------------------------
        | Télécharger un document
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/demandes/{idDemande}/documents/{idDocument}/telecharger',
            [
                EtudiantDemandeStageController::class,
                'telechargerDocument'
            ]
        )->name('documents.telecharger');


        /*
        |--------------------------------------------------------------------------
        | Supprimer un document
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/demandes/{idDemande}/documents/{idDocument}',
            [
                EtudiantDemandeStageController::class,
                'destroyDocument'
            ]
        )->name('documents.destroy');


        /*
        |--------------------------------------------------------------------------
        | Etape 3 : confirmation
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/demandes/{idDemande}/confirmation',
            [
                EtudiantDemandeStageController::class,
                'confirmation'
            ]
        )->name('demandes.confirmation');

        Route::post(
            '/demandes/{idDemande}/confirmer',
            [
                EtudiantDemandeStageController::class,
                'confirmer'
            ]
        )->name('demandes.confirmer');


        /*
        |--------------------------------------------------------------------------
        | Supprimer une demande
        |--------------------------------------------------------------------------
        */

        Route::delete('/demandes/{idDemande}', [
            EtudiantDemandeStageController::class,
            'destroy'
        ])->name('demandes.destroy');


        /*
        |--------------------------------------------------------------------------
        | Mes documents
        |--------------------------------------------------------------------------
        */

        Route::get('/documents', [
            EtudiantDemandeStageController::class,
            'documentsIndex'
        ])->name('documents.index');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        Route::get('/notifications', function () {
            return view('etudiant.notifications');
        })->name('notifications');


        /*
        |--------------------------------------------------------------------------
        | Profil
        |--------------------------------------------------------------------------
        */

        Route::get('/profil', [
            EtudiantProfilController::class,
            'index'
        ])->name('profil');

        Route::get('/profil/modifier', [
            EtudiantProfilController::class,
            'edit'
        ])->name('profil.edit');

        Route::put('/profil', [
            EtudiantProfilController::class,
            'update'
        ])->name('profil.update');
    });


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

        Route::get('/utilisateurs/{idUtilisateur}/edit', [
            AdminUtilisateurController::class,
            'edit'
        ])->name('utilisateurs.edit');

        Route::put('/utilisateurs/{idUtilisateur}', [
            AdminUtilisateurController::class,
            'update'
        ])->name('utilisateurs.update');

        Route::patch('/utilisateurs/{idUtilisateur}/toggle', [
            AdminUtilisateurController::class,
            'toggle'
        ])->name('utilisateurs.toggle');

        Route::delete('/utilisateurs/{idUtilisateur}', [
            AdminUtilisateurController::class,
            'destroy'
        ])->name('utilisateurs.destroy');


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