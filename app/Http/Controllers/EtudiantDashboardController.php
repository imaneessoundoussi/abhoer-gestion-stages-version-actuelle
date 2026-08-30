<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\DemandeStage;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class EtudiantDashboardController extends Controller
{
    /**
     * Tableau de bord étudiant.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | UTILISATEUR CONNECTÉ
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CANDIDAT
        |--------------------------------------------------------------------------
        */

        $candidat = null;

        if (!empty($user->idCandidat)) {
            $candidat = Candidat::where(
                'idCandidat',
                $user->idCandidat
            )->first();
        }

        /*
        |--------------------------------------------------------------------------
        | DEMANDES DE STAGE
        |--------------------------------------------------------------------------
        */

        $demandes = collect();

        if ($candidat) {

            $demandes = DemandeStage::with([
                'service',
                'documents'
            ])
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->orderByDesc('dateDepot')
            ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES
        |--------------------------------------------------------------------------
        */

        $totalDemandes = $demandes->count();

        $demandesEnAttente = $demandes
            ->filter(function ($demande) {

                $statut = strtoupper(
                    str_replace(
                        ' ',
                        '_',
                        trim($demande->statut ?? '')
                    )
                );

                return $statut === 'EN_ATTENTE';
            })
            ->count();

        $demandesAcceptees = $demandes
            ->filter(function ($demande) {

                $statut = strtoupper(
                    str_replace(
                        ' ',
                        '_',
                        trim($demande->statut ?? '')
                    )
                );

                return in_array($statut, [
                    'ACCEPTEE',
                    'ACCEPTE'
                ], true);
            })
            ->count();

        $demandesRefusees = $demandes
            ->filter(function ($demande) {

                $statut = strtoupper(
                    str_replace(
                        ' ',
                        '_',
                        trim($demande->statut ?? '')
                    )
                );

                return in_array($statut, [
                    'REFUSEE',
                    'REFUSE'
                ], true);
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | STAGES EN COURS
        |--------------------------------------------------------------------------
        */

        $stagesEnCours = $demandes
            ->filter(function ($demande) {

                $statut = strtoupper(
                    str_replace(
                        ' ',
                        '_',
                        trim($demande->statut ?? '')
                    )
                );

                return in_array($statut, [
                    'STAGE_EN_COURS',
                    'EN_COURS'
                ], true);
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DERNIÈRES DEMANDES
        |--------------------------------------------------------------------------
        */

        $dernieresDemandes = $demandes->take(5);

        /*
        |--------------------------------------------------------------------------
        | DERNIÈRE DEMANDE
        |--------------------------------------------------------------------------
        */

        $derniereDemande = $demandes->first();

        /*
        |--------------------------------------------------------------------------
        | TOTAL UTILISATEURS
        |--------------------------------------------------------------------------
        */

        $totalUtilisateurs = Utilisateur::count();

        /*
        |--------------------------------------------------------------------------
        | AFFICHAGE
        |--------------------------------------------------------------------------
        */

        return view('etudiant.dashboard', compact(
            'user',
            'candidat',
            'demandes',
            'dernieresDemandes',
            'derniereDemande',
            'totalDemandes',
            'demandesEnAttente',
            'demandesAcceptees',
            'demandesRefusees',
            'stagesEnCours',
            'totalUtilisateurs'
        ));
    }
}