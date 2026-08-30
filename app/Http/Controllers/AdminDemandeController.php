<?php

namespace App\Http\Controllers;

use App\Models\DemandeStage;
use Illuminate\Http\Request;

class AdminDemandeController extends Controller
{
    /**
     * Afficher toutes les demandes de stage.
     */
    public function index(Request $request)
    {
        $query = DemandeStage::with([
            'candidat',
            'service.departement',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Recherche
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('numeroDemande', 'like', '%' . $search . '%')
                    ->orWhere('theme', 'like', '%' . $search . '%')
                    ->orWhereHas('candidat', function ($candidateQuery) use ($search) {
                        $candidateQuery
                            ->where('nom', 'like', '%' . $search . '%')
                            ->orWhere('prenom', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('service', function ($serviceQuery) use ($search) {
                        $serviceQuery->where(
                            'nomService',
                            'like',
                            '%' . $search . '%'
                        );
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre statut
        |--------------------------------------------------------------------------
        */

        if ($request->filled('statut')) {
            $query->where(
                'statut',
                $request->input('statut')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtre type de dépôt
        |--------------------------------------------------------------------------
        */

        if ($request->filled('typeDepot')) {
            $query->where(
                'typeDepot',
                $request->input('typeDepot')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Liste
        |--------------------------------------------------------------------------
        */

        $demandes = $query
            ->orderByDesc('dateDepot')
            ->orderByDesc('idDemande')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistiques
        |--------------------------------------------------------------------------
        */

        $totalDemandes = DemandeStage::count();

        $demandesEnAttente = DemandeStage::where(
            'statut',
            'EN_ATTENTE'
        )->count();

        $demandesAcceptees = DemandeStage::where(
            'statut',
            'ACCEPTEE'
        )->count();

        $demandesRefusees = DemandeStage::where(
            'statut',
            'REFUSEE'
        )->count();

        return view(
            'admin.demandes.index',
            compact(
                'demandes',
                'totalDemandes',
                'demandesEnAttente',
                'demandesAcceptees',
                'demandesRefusees'
            )
        );
    }

    /**
     * Afficher le détail d'une demande.
     */
    public function show(int $id)
    {
        $demande = DemandeStage::with([
            'candidat',
            'service.departement',
        ])->findOrFail($id);

        return view(
            'admin.demandes.show',
            compact('demande')
        );
    }
}