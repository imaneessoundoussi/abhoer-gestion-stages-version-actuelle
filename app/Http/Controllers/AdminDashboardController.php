<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\DemandeStage;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * Tableau de bord administrateur.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES GENERALES
        |--------------------------------------------------------------------------
        */

        $totalUtilisateurs = Utilisateur::count();

        $totalCandidats = Candidat::count();

        $totalServices = Service::count();

        $totalDemandes = DemandeStage::count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES PAR STATUT
        |--------------------------------------------------------------------------
        */

        $demandesEnAttente = DemandeStage::whereRaw(
            "UPPER(REPLACE(statut, ' ', '_')) = ?",
            ['EN_ATTENTE']
        )->count();

        $demandesAcceptees = DemandeStage::whereRaw(
            "UPPER(REPLACE(statut, ' ', '_')) IN (?, ?)",
            ['ACCEPTEE', 'ACCEPTE']
        )->count();

        $demandesRefusees = DemandeStage::whereRaw(
            "UPPER(REPLACE(statut, ' ', '_')) IN (?, ?)",
            ['REFUSEE', 'REFUSE']
        )->count();


        /*
        |--------------------------------------------------------------------------
        | STAGES EN COURS
        |--------------------------------------------------------------------------
        */

        $aujourdHui = Carbon::today();

        $stagesEnCours = DemandeStage::whereRaw(
            "UPPER(REPLACE(statut, ' ', '_')) IN (?, ?)",
            ['ACCEPTEE', 'ACCEPTE']
        )
        ->whereDate('dateDebut', '<=', $aujourdHui)
        ->whereDate('dateFin', '>=', $aujourdHui)
        ->count();


        /*
        |--------------------------------------------------------------------------
        | STAGES TERMINES
        |--------------------------------------------------------------------------
        */

        $stagesTermines = DemandeStage::whereRaw(
            "UPPER(REPLACE(statut, ' ', '_')) IN (?, ?)",
            ['ACCEPTEE', 'ACCEPTE']
        )
        ->whereDate('dateFin', '<', $aujourdHui)
        ->count();


        /*
        |--------------------------------------------------------------------------
        | DEMANDES PAR MOIS
        |--------------------------------------------------------------------------
        */

        $demandesParMois = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $nomMois = $date->translatedFormat('M Y');

            $nombre = DemandeStage::whereYear(
                'dateDepot',
                $date->year
            )
            ->whereMonth(
                'dateDepot',
                $date->month
            )
            ->count();

            $demandesParMois[] = [
                'mois' => ucfirst($nomMois),
                'nombre' => $nombre,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | DERNIERES DEMANDES
        |--------------------------------------------------------------------------
        */

        $dernieresDemandes = DemandeStage::with([
            'candidat',
            'service',
        ])
        ->orderByDesc('dateDepot')
        ->limit(6)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | ACTIVITES RECENTES
        |--------------------------------------------------------------------------
        */

        $activitesRecentes = DemandeStage::with([
            'candidat',
            'service',
        ])
        ->orderByDesc('dateDepot')
        ->limit(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | ENVOI A LA VUE
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalUtilisateurs',
                'totalCandidats',
                'totalServices',
                'totalDemandes',
                'demandesEnAttente',
                'demandesAcceptees',
                'demandesRefusees',
                'stagesEnCours',
                'stagesTermines',
                'demandesParMois',
                'dernieresDemandes',
                'activitesRecentes'
            )
        );
    }
}