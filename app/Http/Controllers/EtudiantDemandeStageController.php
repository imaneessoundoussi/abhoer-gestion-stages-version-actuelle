<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\DemandeStage;
use App\Models\Document;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EtudiantDemandeStageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Liste des demandes
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with('error', 'Profil étudiant introuvable.');
        }

        $demandes = DemandeStage::with([
            'service',
            'documents',
        ])
            ->where('idCandidat', $candidat->idCandidat)
            ->orderByDesc('dateDepot')
            ->get();

        return view('etudiant.demandes.index', [
            'demandes' => $demandes,
            'candidat' => $candidat,
            'user' => $user,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Nouvelle demande
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return redirect()->route(
            'etudiant.demandes.informations'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Étape 1 : informations
    |--------------------------------------------------------------------------
    */

    public function informations()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        $services = Service::orderBy(
            'nomService',
            'asc'
        )->get();

        return view('etudiant.demandes.informations', [
            'services' => $services,
            'candidat' => $candidat,
            'user' => $user,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Enregistrer l'étape 1
    |--------------------------------------------------------------------------
    */

    public function storeInformations(Request $request)
    {
        $validated = $request->validate(
            [
                'idService' => [
                    'required',
                    'integer',
                    'exists:service,idService',
                ],

                'typeDepot' => [
                    'required',
                    'string',
                    'max:50',
                ],

                'dateDebut' => [
                    'required',
                    'date',
                ],

                'dateFin' => [
                    'required',
                    'date',
                    'after_or_equal:dateDebut',
                ],

                'theme' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'motivation' => [
                    'required',
                    'string',
                    'min:10',
                ],
            ],
            [
                'idService.required' =>
                    'Veuillez sélectionner un service.',

                'idService.exists' =>
                    'Le service sélectionné est invalide.',

                'typeDepot.required' =>
                    'Veuillez sélectionner le type de stage.',

                'dateDebut.required' =>
                    'Veuillez indiquer la date de début.',

                'dateFin.required' =>
                    'Veuillez indiquer la date de fin.',

                'dateFin.after_or_equal' =>
                    'La date de fin doit être après ou égale à la date de début.',

                'theme.required' =>
                    'Veuillez indiquer le thème du stage.',

                'motivation.required' =>
                    'Veuillez indiquer votre motivation.',

                'motivation.min' =>
                    'La motivation doit contenir au moins 10 caractères.',
            ]
        );

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find($user->idCandidat);

        if (!$candidat) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Aucun profil candidat associé à cet utilisateur.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Génération du numéro unique
        |--------------------------------------------------------------------------
        */

        do {
            $numeroDemande =
                'DEM-' .
                date('Y') .
                '-' .
                strtoupper(Str::random(6));

        } while (
            DemandeStage::where(
                'numeroDemande',
                $numeroDemande
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Création de la demande
        |--------------------------------------------------------------------------
        */

        $demande = DemandeStage::create([
            'idCandidat' => $candidat->idCandidat,
            'idService' => $validated['idService'],
            'numeroDemande' => $numeroDemande,
            'dateDepot' => now()->format('Y-m-d'),
            'dateDebut' => $validated['dateDebut'],
            'dateFin' => $validated['dateFin'],
            'theme' => $validated['theme'],
            'motivation' => $validated['motivation'],
            'statut' => 'EN_ATTENTE',
            'typeDepot' => $validated['typeDepot'],
            'observation' => null,
        ]);

        return redirect()
            ->route(
                'etudiant.demandes.documents',
                [
                    'idDemande' => $demande->idDemande,
                ]
            )
            ->with(
                'success',
                'Les informations de votre demande ont été enregistrées.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Compatibilité avec store()
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        return $this->storeInformations($request);
    }


    /*
    |--------------------------------------------------------------------------
    | Afficher les documents d'une demande
    |--------------------------------------------------------------------------
    */

    public function documents(int $idDemande)
    {
        $demande = $this->getDemandeEtudiant($idDemande);

        $documents = Document::where(
            'idDemande',
            $demande->idDemande
        )
            ->orderByDesc('dateAjout')
            ->get();

        return view('etudiant.demandes.documents', [
            'demande' => $demande,
            'documents' => $documents,
            'user' => Auth::user(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Enregistrer les documents
    |--------------------------------------------------------------------------
    */

    public function storeDocuments(
        Request $request,
        int $idDemande
    ) {
        $demande = $this->getDemandeEtudiant($idDemande);

        $statut = strtoupper(
            (string) $demande->statut
        );

        /*
        |--------------------------------------------------------------------------
        | Une demande traitée ne peut plus être modifiée
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $statut,
            [
                'EN_ATTENTE',
                'BROUILLON',
            ],
            true
        )) {
            return redirect()
                ->route(
                    'etudiant.demandes.documents',
                    [
                        'idDemande' => $demande->idDemande,
                    ]
                )
                ->with(
                    'error',
                    'Les documents ne peuvent plus être modifiés car cette demande est déjà en cours de traitement.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate(
            [
                'documents' => [
                    'required',
                    'array',
                    'size:4',
                ],

                'documents.*.type' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'documents.*.fichier' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120',
                ],
            ],
            [
                'documents.required' =>
                    'Veuillez ajouter les documents demandés.',

                'documents.size' =>
                    'Les quatre documents sont obligatoires.',

                'documents.*.type.required' =>
                    'Le type du document est obligatoire.',

                'documents.*.fichier.required' =>
                    'Veuillez sélectionner tous les documents.',

                'documents.*.fichier.file' =>
                    'Le fichier sélectionné est invalide.',

                'documents.*.fichier.mimes' =>
                    'Le document doit être au format PDF, JPG, JPEG ou PNG.',

                'documents.*.fichier.max' =>
                    'Le fichier ne doit pas dépasser 5 MB.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Types autorisés
        |--------------------------------------------------------------------------
        */

        $typesAutorises = [
            'CIN',
            'Demande de stage',
            'Assurance',
            'CV',
        ];


        /*
        |--------------------------------------------------------------------------
        | Enregistrement des documents
        |--------------------------------------------------------------------------
        */

        foreach (
            $request->input('documents', [])
            as $index => $documentData
        ) {
            if (!is_array($documentData)) {
                continue;
            }

            $type = $documentData['type'] ?? null;

            if (!$type) {
                continue;
            }

            if (!in_array(
                $type,
                $typesAutorises,
                true
            )) {
                continue;
            }

            $fichier = $request->file(
                "documents.$index.fichier"
            );

            if (!$fichier) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Chercher un ancien document du même type
            |--------------------------------------------------------------------------
            */

            $ancienDocument = Document::where(
                'idDemande',
                $demande->idDemande
            )
                ->where(
                    'typeDocument',
                    $type
                )
                ->first();


            /*
            |--------------------------------------------------------------------------
            | Supprimer ancien fichier
            |--------------------------------------------------------------------------
            */

            if ($ancienDocument) {

                if (
                    $ancienDocument->cheminFichier &&
                    Storage::disk('public')->exists(
                        $ancienDocument->cheminFichier
                    )
                ) {
                    Storage::disk('public')->delete(
                        $ancienDocument->cheminFichier
                    );
                }

                $ancienDocument->delete();
            }


            /*
            |--------------------------------------------------------------------------
            | Stocker le nouveau fichier
            |--------------------------------------------------------------------------
            */

            $chemin = $fichier->store(
                'documents',
                'public'
            );


            /*
            |--------------------------------------------------------------------------
            | Enregistrer dans la base de données
            |--------------------------------------------------------------------------
            */

            Document::create([
                'idDemande' => $demande->idDemande,

                'typeDocument' => $type,

                'nomFichier' =>
                    $fichier->getClientOriginalName(),

                'cheminFichier' => $chemin,

                'dateAjout' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Vérifier les 4 documents
        |--------------------------------------------------------------------------
        */

        $nombreDocuments = Document::where(
            'idDemande',
            $demande->idDemande
        )->count();

        if ($nombreDocuments < 4) {

            return redirect()
                ->route(
                    'etudiant.demandes.documents',
                    [
                        'idDemande' =>
                            $demande->idDemande,
                    ]
                )
                ->with(
                    'error',
                    'Les quatre documents obligatoires doivent être ajoutés.'
                );
        }


        return redirect()
            ->route(
                'etudiant.demandes.confirmation',
                [
                    'idDemande' =>
                        $demande->idDemande,
                ]
            )
            ->with(
                'success',
                'Les documents ont été enregistrés avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Confirmation
    |--------------------------------------------------------------------------
    */

    public function confirmation(int $idDemande)
    {
        $demande = $this->getDemandeEtudiant($idDemande);

        $demande->load([
            'candidat',
            'service',
            'documents',
        ]);

        return view(
            'etudiant.demandes.confirmation',
            [
                'demande' => $demande,
                'user' => Auth::user(),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Confirmation définitive
    |--------------------------------------------------------------------------
    */

    public function confirmer(int $idDemande)
    {
        $demande = $this->getDemandeEtudiant($idDemande);

        $nombreDocuments =
            $demande->documents()->count();

        if ($nombreDocuments < 4) {

            return redirect()
                ->route(
                    'etudiant.demandes.documents',
                    [
                        'idDemande' =>
                            $demande->idDemande,
                    ]
                )
                ->with(
                    'error',
                    'Vous devez ajouter les 4 documents obligatoires avant de confirmer.'
                );
        }


        $demande->statut = 'EN_ATTENTE';

        $demande->save();


        return redirect()
            ->route(
                'etudiant.demandes.index'
            )
            ->with(
                'success',
                'Votre demande de stage a été envoyée avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Voir une demande
    |--------------------------------------------------------------------------
    */

    public function show(int $idDemande)
    {
        $demande = $this->getDemandeEtudiant($idDemande);

        $demande->load([
            'candidat',
            'service',
            'documents',
        ]);

        return view(
            'etudiant.demandes.show',
            [
                'demande' => $demande,
                'user' => Auth::user(),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Mes documents
    |--------------------------------------------------------------------------
    */

    public function documentsIndex()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $candidat = Candidat::find(
            $user->idCandidat
        );

        if (!$candidat) {
            return redirect()
                ->route('etudiant.profil')
                ->with(
                    'error',
                    'Profil étudiant introuvable.'
                );
        }

        $demandes = DemandeStage::with([
            'service',
            'documents',
        ])
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->orderByDesc('dateDepot')
            ->get();

        return view(
            'etudiant.documents.index',
            [
                'demandes' => $demandes,
                'candidat' => $candidat,
                'user' => $user,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER UNE DEMANDE
    |--------------------------------------------------------------------------
    |
    | Supprime :
    | - les documents de la base
    | - les fichiers physiques
    | - la demande
    |
    */

    public function destroy(int $idDemande)
    {
        $demande = $this->getDemandeEtudiant($idDemande);

        $statut = strtoupper(
            (string) $demande->statut
        );


        /*
        |--------------------------------------------------------------------------
        | Vérifier le statut
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $statut,
            [
                'EN_ATTENTE',
                'BROUILLON',
            ],
            true
        )) {

            return redirect()
                ->route(
                    'etudiant.demandes.index'
                )
                ->with(
                    'error',
                    'Cette demande ne peut plus être supprimée car elle est déjà en cours de traitement.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer les documents et fichiers
        |--------------------------------------------------------------------------
        */

        $documents = Document::where(
            'idDemande',
            $demande->idDemande
        )->get();

        foreach ($documents as $document) {

            if (
                $document->cheminFichier &&
                Storage::disk('public')->exists(
                    $document->cheminFichier
                )
            ) {
                Storage::disk('public')->delete(
                    $document->cheminFichier
                );
            }

            $document->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer la demande
        |--------------------------------------------------------------------------
        */

        $demande->delete();


        return redirect()
            ->route(
                'etudiant.demandes.index'
            )
            ->with(
                'success',
                'La demande et tous ses documents ont été supprimés avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | VOIR UN DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function voirDocument(
        int $idDemande,
        int $idDocument
    ) {
        $demande = $this->getDemandeEtudiant(
            $idDemande
        );

        $document = Document::where(
            'idDocument',
            $idDocument
        )
            ->where(
                'idDemande',
                $demande->idDemande
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Vérifier le fichier
        |--------------------------------------------------------------------------
        */

        if (
            !$document->cheminFichier ||
            !Storage::disk('public')->exists(
                $document->cheminFichier
            )
        ) {
            abort(
                404,
                'Fichier introuvable.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Chemin physique
        |--------------------------------------------------------------------------
        */

        $path = Storage::disk('public')->path(
            $document->cheminFichier
        );


        /*
        |--------------------------------------------------------------------------
        | Type MIME
        |--------------------------------------------------------------------------
        */

        $mimeType = mime_content_type(
            $path
        );

        if (!$mimeType) {
            $mimeType =
                'application/octet-stream';
        }


        /*
        |--------------------------------------------------------------------------
        | Afficher le document dans le navigateur
        |--------------------------------------------------------------------------
        */

        return response()->file(
            $path,
            [
                'Content-Type' => $mimeType,

                'Content-Disposition' =>
                    'inline; filename="' .
                    addslashes(
                        $document->nomFichier
                    ) .
                    '"',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TÉLÉCHARGER UN DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function telechargerDocument(
        int $idDemande,
        int $idDocument
    ) {
        $demande = $this->getDemandeEtudiant(
            $idDemande
        );

        $document = Document::where(
            'idDocument',
            $idDocument
        )
            ->where(
                'idDemande',
                $demande->idDemande
            )
            ->firstOrFail();


        if (
            !$document->cheminFichier ||
            !Storage::disk('public')->exists(
                $document->cheminFichier
            )
        ) {
            abort(
                404,
                'Fichier introuvable.'
            );
        }


        $path = Storage::disk('public')->path(
            $document->cheminFichier
        );


        return response()->download(
            $path,
            $document->nomFichier
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER UN DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function destroyDocument(
        int $idDemande,
        int $idDocument
    ) {
        $demande = $this->getDemandeEtudiant(
            $idDemande
        );


        /*
        |--------------------------------------------------------------------------
        | Vérifier le statut
        |--------------------------------------------------------------------------
        */

        $statut = strtoupper(
            (string) $demande->statut
        );

        if (!in_array(
            $statut,
            [
                'EN_ATTENTE',
                'BROUILLON',
            ],
            true
        )) {

            return redirect()
                ->route(
                    'etudiant.demandes.documents',
                    [
                        'idDemande' =>
                            $demande->idDemande,
                    ]
                )
                ->with(
                    'error',
                    'Ce document ne peut plus être supprimé car la demande est déjà en cours de traitement.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Trouver le document
        |--------------------------------------------------------------------------
        */

        $document = Document::where(
            'idDocument',
            $idDocument
        )
            ->where(
                'idDemande',
                $demande->idDemande
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Supprimer le fichier physique
        |--------------------------------------------------------------------------
        */

        if (
            $document->cheminFichier &&
            Storage::disk('public')->exists(
                $document->cheminFichier
            )
        ) {
            Storage::disk('public')->delete(
                $document->cheminFichier
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer de la base
        |--------------------------------------------------------------------------
        */

        $document->delete();


        return redirect()
            ->route(
                'etudiant.demandes.documents',
                [
                    'idDemande' =>
                        $demande->idDemande,
                ]
            )
            ->with(
                'success',
                'Le document a été supprimé avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Vérifier que la demande appartient à l'étudiant
    |--------------------------------------------------------------------------
    */

    private function getDemandeEtudiant(
        int $idDemande
    ): DemandeStage {

        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        if (!$user->idCandidat) {
            abort(
                403,
                'Aucun candidat associé à cet utilisateur.'
            );
        }

        $candidat = Candidat::findOrFail(
            $user->idCandidat
        );


        return DemandeStage::with([
            'service',
            'candidat',
            'documents',
        ])
            ->where(
                'idDemande',
                $idDemande
            )
            ->where(
                'idCandidat',
                $candidat->idCandidat
            )
            ->firstOrFail();
    }
}