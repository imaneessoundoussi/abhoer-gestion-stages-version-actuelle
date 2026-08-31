<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminStageController extends Controller
{
    /**
     * Afficher la liste des stages.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Requête principale
        |--------------------------------------------------------------------------
        */

        $query = DB::table('affectation')
            ->join(
                'demande_stage',
                'affectation.idDemande',
                '=',
                'demande_stage.idDemande'
            )
            ->leftJoin(
                'candidat',
                'demande_stage.idCandidat',
                '=',
                'candidat.idCandidat'
            )
            ->leftJoin(
                'service',
                'affectation.idService',
                '=',
                'service.idService'
            )
            ->leftJoin(
                'departement',
                'service.idDepartement',
                '=',
                'departement.idDepartement'
            )
            ->select(
                'affectation.idAffectation',
                'affectation.idDemande',
                'affectation.idService',
                'affectation.dateAffectation',
                'affectation.dateDebut',
                'affectation.dateFin',
                'affectation.observation',

                'demande_stage.numeroDemande',
                'demande_stage.theme',
                'demande_stage.statut',
                'demande_stage.typeDepot',

                'candidat.idCandidat',
                'candidat.nom',
                'candidat.prenom',
                'candidat.email',

                'service.nomService',
                'departement.nomDepartement'
            );

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {

                $q->where(
                    'demande_stage.numeroDemande',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'demande_stage.theme',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'candidat.nom',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'candidat.prenom',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'candidat.email',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'service.nomService',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'departement.nomDepartement',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par statut
        |--------------------------------------------------------------------------
        */

        if ($request->filled('statut')) {

            $query->where(
                'demande_stage.statut',
                $request->input('statut')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre par période
        |--------------------------------------------------------------------------
        */

        if ($request->filled('periode')) {

            $periode = $request->input('periode');

            $today = Carbon::today();

            /*
            |--------------------------------------------------------------------------
            | Stage en cours
            |--------------------------------------------------------------------------
            */

            if ($periode === 'en_cours') {

                $query
                    ->whereDate(
                        'affectation.dateDebut',
                        '<=',
                        $today
                    )
                    ->whereDate(
                        'affectation.dateFin',
                        '>=',
                        $today
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Stage à venir
            |--------------------------------------------------------------------------
            */

            elseif ($periode === 'a_venir') {

                $query->whereDate(
                    'affectation.dateDebut',
                    '>',
                    $today
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Stage terminé
            |--------------------------------------------------------------------------
            */

            elseif ($periode === 'termine') {

                $query->whereDate(
                    'affectation.dateFin',
                    '<',
                    $today
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Liste des stages
        |--------------------------------------------------------------------------
        */

        $stages = $query
            ->orderByDesc('affectation.dateAffectation')
            ->orderByDesc('affectation.idAffectation')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistiques
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | Total stages
        |--------------------------------------------------------------------------
        */

        $totalStages = DB::table('affectation')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Stages en cours
        |--------------------------------------------------------------------------
        */

        $stagesEnCours = DB::table('affectation')
            ->whereNotNull('dateDebut')
            ->whereNotNull('dateFin')
            ->whereDate(
                'dateDebut',
                '<=',
                $today
            )
            ->whereDate(
                'dateFin',
                '>=',
                $today
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Stages à venir
        |--------------------------------------------------------------------------
        */

        $stagesAVenir = DB::table('affectation')
            ->whereNotNull('dateDebut')
            ->whereDate(
                'dateDebut',
                '>',
                $today
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Stages terminés
        |--------------------------------------------------------------------------
        */

        $stagesTermines = DB::table('affectation')
            ->whereNotNull('dateFin')
            ->whereDate(
                'dateFin',
                '<',
                $today
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Retour vers la vue
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.stages.index',
            compact(
                'stages',
                'totalStages',
                'stagesEnCours',
                'stagesAVenir',
                'stagesTermines'
            )
        );
    }

    /**
     * Afficher le détail d'un stage.
     *
     * IMPORTANT :
     * La route reçoit ici l'idDemande.
     */
    public function show(int $idDemande)
    {
        $stage = DB::table('affectation')
            ->join(
                'demande_stage',
                'affectation.idDemande',
                '=',
                'demande_stage.idDemande'
            )
            ->leftJoin(
                'candidat',
                'demande_stage.idCandidat',
                '=',
                'candidat.idCandidat'
            )
            ->leftJoin(
                'service',
                'affectation.idService',
                '=',
                'service.idService'
            )
            ->leftJoin(
                'departement',
                'service.idDepartement',
                '=',
                'departement.idDepartement'
            )
            ->select(

                /*
                |--------------------------------------------------------------------------
                | Affectation
                |--------------------------------------------------------------------------
                */

                'affectation.idAffectation',
                'affectation.idDemande',
                'affectation.idService',
                'affectation.dateAffectation',
                'affectation.dateDebut',
                'affectation.dateFin',
                'affectation.observation',

                /*
                |--------------------------------------------------------------------------
                | Demande
                |--------------------------------------------------------------------------
                */

                'demande_stage.numeroDemande',
                'demande_stage.theme',
                'demande_stage.motivation',
                'demande_stage.statut',
                'demande_stage.typeDepot',

                /*
                |--------------------------------------------------------------------------
                | Candidat
                |--------------------------------------------------------------------------
                */

                'candidat.idCandidat',
                'candidat.nom',
                'candidat.prenom',
                'candidat.email',
                'candidat.telephone',
                'candidat.cin',
                'candidat.etablissement',
                'candidat.formation',
                'candidat.niveauEtude',

                /*
                |--------------------------------------------------------------------------
                | Service
                |--------------------------------------------------------------------------
                */

                'service.idService',
                'service.nomService',
                'service.description as descriptionService',

                /*
                |--------------------------------------------------------------------------
                | Département
                |--------------------------------------------------------------------------
                */

                'departement.idDepartement',
                'departement.nomDepartement'
            )

            /*
            |--------------------------------------------------------------------------
            | Recherche par ID de demande
            |--------------------------------------------------------------------------
            */

            ->where(
                'affectation.idDemande',
                $idDemande
            )

            ->first();

        /*
        |--------------------------------------------------------------------------
        | Stage introuvable
        |--------------------------------------------------------------------------
        */

        abort_if(!$stage, 404);

        /*
        |--------------------------------------------------------------------------
        | Affichage
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.stages.show',
            compact('stage')
        );
    }
}