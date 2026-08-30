<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminJournalController extends Controller
{
    /**
     * Afficher le journal des activités.
     */
    public function index(Request $request)
    {
        $query = DB::table('historique')
            ->leftJoin(
                'utilisateur',
                'historique.idUtilisateur',
                '=',
                'utilisateur.idUtilisateur'
            )
            ->leftJoin(
                'demande_stage',
                'historique.idDemande',
                '=',
                'demande_stage.idDemande'
            )
            ->select(
                'historique.idHistorique',
                'historique.action',
                'historique.dateAction',
                'historique.ancienneValeur',
                'historique.nouvelleValeur',
                'utilisateur.nom',
                'utilisateur.prenom',
                'utilisateur.role',
                'demande_stage.numeroDemande'
            );

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where(
                    'historique.action',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'utilisateur.nom',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'utilisateur.prenom',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'demande_stage.numeroDemande',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        $activites = $query
            ->orderByDesc('historique.dateAction')
            ->paginate(15)
            ->withQueryString();

        $totalActivites = DB::table('historique')->count();

        return view(
            'admin.journal.index',
            compact(
                'activites',
                'totalActivites'
            )
        );
    }
}