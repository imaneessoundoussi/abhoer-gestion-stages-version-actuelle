<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Document;
use App\Models\DemandeStage;
use Illuminate\Support\Facades\Auth;

class EtudiantDocumentController extends Controller
{
    /**
     * Afficher les documents de l'étudiant connecté.
     */
    public function index()
    {
        $utilisateur = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Récupération du candidat
        |--------------------------------------------------------------------------
        */

        $candidat = Candidat::find($utilisateur->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Récupération des demandes
        |--------------------------------------------------------------------------
        |
        | On récupère uniquement les demandes de l'étudiant connecté.
        |
        */

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

        /*
        |--------------------------------------------------------------------------
        | Affichage
        |--------------------------------------------------------------------------
        */

        return view(
            'etudiant.demandes.documents-liste',
            compact(
                'demandes',
                'candidat'
            )
        );
    }
}