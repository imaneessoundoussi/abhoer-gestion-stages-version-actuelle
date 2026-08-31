<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Tableau de bord administrateur.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATE ACTUELLE
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES DES DEMANDES
        |--------------------------------------------------------------------------
        */

        $totalDemandes = DB::table('demande_stage')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DEMANDES EN ATTENTE
        |--------------------------------------------------------------------------
        */

        $demandesEnAttente = DB::table('demande_stage')
            ->where(function ($query) {
                $query->where('statut', 'EN_ATTENTE')
                    ->orWhere('statut', 'en_attente');
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DEMANDES ACCEPTÉES
        |--------------------------------------------------------------------------
        |
        | Une demande acceptée peut ensuite passer à :
        |
        | ACCEPTEE
        | STAGE_EN_COURS
        | TERMINEE
        |
        | On les considère donc comme des demandes acceptées.
        |
        */

        $demandesAcceptees = DB::table('demande_stage')
            ->whereIn('statut', [
                'ACCEPTEE',
                'ACCEPTE',
                'STAGE_EN_COURS',
                'TERMINEE'
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DEMANDES REFUSÉES
        |--------------------------------------------------------------------------
        */

        $demandesRefusees = DB::table('demande_stage')
            ->whereIn('statut', [
                'REFUSEE',
                'REFUSE'
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | UTILISATEURS
        |--------------------------------------------------------------------------
        */

        $totalUtilisateurs = DB::table('utilisateur')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | CANDIDATS
        |--------------------------------------------------------------------------
        */

        $totalCandidats = DB::table('candidat')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | SERVICES
        |--------------------------------------------------------------------------
        */

        $totalServices = DB::table('service')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DÉPARTEMENTS
        |--------------------------------------------------------------------------
        */

        $totalDepartements = DB::table('departement')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STAGES
        |--------------------------------------------------------------------------
        |
        | Un stage existe lorsqu'une affectation existe.
        |
        */

        $totalStages = DB::table('affectation')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STAGES EN COURS
        |--------------------------------------------------------------------------
        */

        $stagesEnCours = DB::table('affectation')
            ->whereNotNull('dateDebut')
            ->whereNotNull('dateFin')
            ->whereDate('dateDebut', '<=', $today)
            ->whereDate('dateFin', '>=', $today)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STAGES À VENIR
        |--------------------------------------------------------------------------
        */

        $stagesAVenir = DB::table('affectation')
            ->whereNotNull('dateDebut')
            ->whereDate('dateDebut', '>', $today)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STAGES TERMINÉS
        |--------------------------------------------------------------------------
        */

        $stagesTermines = DB::table('affectation')
            ->whereNotNull('dateFin')
            ->whereDate('dateFin', '<', $today)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DERNIÈRES DEMANDES
        |--------------------------------------------------------------------------
        */

        $dernieresDemandes = DB::table('demande_stage')
            ->leftJoin(
                'candidat',
                'demande_stage.idCandidat',
                '=',
                'candidat.idCandidat'
            )
            ->leftJoin(
                'service',
                'demande_stage.idService',
                '=',
                'service.idService'
            )
            ->select(
                'demande_stage.*',
                'candidat.nom',
                'candidat.prenom',
                'candidat.email',
                'service.nomService'
            )
            ->orderByDesc('demande_stage.dateDepot')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETOUR VERS LE DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalDemandes',
                'demandesEnAttente',
                'demandesAcceptees',
                'demandesRefusees',
                'totalUtilisateurs',
                'totalCandidats',
                'totalServices',
                'totalDepartements',
                'totalStages',
                'stagesEnCours',
                'stagesAVenir',
                'stagesTermines',
                'dernieresDemandes'
            )
        );
    }
}