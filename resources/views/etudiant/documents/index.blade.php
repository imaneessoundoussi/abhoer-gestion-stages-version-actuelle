``
@extends('layouts.etudiant')

@section('page-title', 'Mes documents')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
         EN-TÊTE
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-folder2-open me-2"></i>
                Mes documents
            </h2>

            <p class="text-muted mb-0">
                Retrouvez les documents associés à vos demandes de stage.
            </p>
        </div>

    </div>


    {{-- =========================================================
         MESSAGES DE SUCCÈS
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fermer">
            </button>

        </div>

    @endif


    {{-- =========================================================
         MESSAGES D'ERREUR
    ========================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fermer">
            </button>

        </div>

    @endif


    {{-- =========================================================
         ERREURS DE VALIDATION
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Une ou plusieurs erreurs sont survenues :
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Fermer">
            </button>

        </div>

    @endif


    {{-- =========================================================
         AUCUNE DEMANDE
    ========================================================== --}}

    @if($demandes->isEmpty())

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <div class="mb-3">

                    <i
                        class="bi bi-folder-x"
                        style="font-size: 4rem; color: #adb5bd;">
                    </i>

                </div>

                <h5 class="fw-bold">
                    Aucun document
                </h5>

                <p class="text-muted mb-4">
                    Vous n'avez encore aucun document associé à une demande de stage.
                </p>

                <a
                    href="{{ route('etudiant.demandes.create') }}"
                    class="btn btn-primary">

                    <i class="bi bi-plus-lg me-1"></i>

                    Créer une demande

                </a>

            </div>

        </div>

    @else

        {{-- =====================================================
             LISTE DES DEMANDES
        ====================================================== --}}

        @foreach($demandes as $demande)

            @php

                $statut = strtoupper(
                    (string) ($demande->statut ?? '')
                );

                $badge = match($statut) {

                    'ACCEPTEE' => 'success',

                    'REFUSEE' => 'danger',

                    'EN_COURS' => 'warning',

                    'EN_ATTENTE' => 'secondary',

                    'STAGE_EN_COURS' => 'primary',

                    'TERMINEE' => 'success',

                    'BROUILLON' => 'secondary',

                    default => 'secondary',

                };

            @endphp


            {{-- =================================================
                 CARTE DEMANDE
            ================================================== --}}

            <div class="card border-0 shadow-sm mb-4">


                {{-- =================================================
                     EN-TÊTE DE LA DEMANDE
                ================================================== --}}

                <div class="card-header bg-white border-0 py-3">

                    <div class="row align-items-center">


                        {{-- INFORMATIONS DEMANDE --}}

                        <div class="col-md-8">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                    style="width: 45px; height: 45px;">

                                    <i class="bi bi-file-earmark-text text-primary fs-5"></i>

                                </div>

                                <div>

                                    <h5 class="fw-bold mb-1">

                                        {{ $demande->numeroDemande ?? 'Demande #' . $demande->idDemande }}

                                    </h5>

                                    <div class="text-muted small">

                                        <i class="bi bi-building me-1"></i>

                                        {{ $demande->service->nomService ?? 'Service non précisé' }}

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- STATUT --}}

                        <div class="col-md-4 text-md-end mt-3 mt-md-0">

                            <span class="badge text-bg-{{ $badge }} px-3 py-2">

                                {{ str_replace('_', ' ', $demande->statut ?? '—') }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DOCUMENTS
                ================================================== --}}

                <div class="card-body pt-2">


                    {{-- Vérification de la relation documents --}}

                    @if($demande->documents && $demande->documents->isNotEmpty())

                        <div class="row g-3">


                            @foreach($demande->documents as $document)

                                <div class="col-12">

                                    <div class="border rounded-3 p-3">

                                        <div class="row align-items-center">


                                            {{-- =================================================
                                                 INFORMATIONS DOCUMENT
                                            ================================================== --}}

                                            <div class="col-md-6">

                                                <div class="d-flex align-items-center">


                                                    {{-- ICÔNE DOCUMENT --}}

                                                    @php

                                                        $nomFichier = $document->nomFichier ?? '';

                                                        $extension = strtolower(
                                                            pathinfo(
                                                                $nomFichier,
                                                                PATHINFO_EXTENSION
                                                            )
                                                        );

                                                        $icone = match($extension) {

                                                            'pdf' =>
                                                                'bi-file-earmark-pdf',

                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp' =>
                                                                'bi-file-earmark-image',

                                                            'doc',
                                                            'docx' =>
                                                                'bi-file-earmark-word',

                                                            'xls',
                                                            'xlsx' =>
                                                                'bi-file-earmark-excel',

                                                            'ppt',
                                                            'pptx' =>
                                                                'bi-file-earmark-ppt',

                                                            'zip',
                                                            'rar' =>
                                                                'bi-file-earmark-zip',

                                                            default =>
                                                                'bi-file-earmark',

                                                        };

                                                    @endphp


                                                    <div
                                                        class="rounded-3 bg-light d-flex align-items-center justify-content-center me-3"
                                                        style="width: 48px; height: 48px;">

                                                        <i
                                                            class="bi {{ $icone }} fs-4 text-primary">
                                                        </i>

                                                    </div>


                                                    {{-- INFORMATIONS --}}

                                                    <div style="min-width: 0;">

                                                        <div class="fw-semibold">

                                                            {{ $document->typeDocument ?? 'Document' }}

                                                        </div>


                                                        <div
                                                            class="text-muted small text-truncate"
                                                            style="max-width: 350px;"
                                                            title="{{ $nomFichier }}">

                                                            {{ $nomFichier ?: 'Nom du fichier non disponible' }}

                                                        </div>


                                                        <div class="text-muted small mt-1">

                                                            <i class="bi bi-clock me-1"></i>

                                                            Ajouté le

                                                            @if(!empty($document->dateAjout))

                                                                {{ \Carbon\Carbon::parse($document->dateAjout)->format('d/m/Y à H:i') }}

                                                            @else

                                                                —

                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- =================================================
                                                 ACTIONS
                                            ================================================== --}}

                                            <div class="col-md-6">

                                                <div
                                                    class="d-flex justify-content-md-end gap-2 mt-3 mt-md-0 flex-wrap">


                                                    {{-- =================================================
                                                         VOIR
                                                    ================================================== --}}

                                                    <a
                                                        href="{{ route(
                                                            'etudiant.documents.voir',
                                                            [
                                                                'idDemande' => $demande->idDemande,
                                                                'idDocument' => $document->idDocument
                                                            ]
                                                        ) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-outline-primary">

                                                        <i class="bi bi-eye me-1"></i>

                                                        Voir

                                                    </a>


                                                    {{-- =================================================
                                                         TÉLÉCHARGER
                                                    ================================================== --}}

                                                    <a
                                                        href="{{ route(
                                                            'etudiant.documents.telecharger',
                                                            [
                                                                'idDemande' => $demande->idDemande,
                                                                'idDocument' => $document->idDocument
                                                            ]
                                                        ) }}"
                                                        class="btn btn-sm btn-outline-secondary">

                                                        <i class="bi bi-download me-1"></i>

                                                        Télécharger

                                                    </a>


                                                    {{-- =================================================
                                                         SUPPRIMER
                                                         ACTIF POUR TOUS LES STATUTS
                                                    ================================================== --}}

                                                    <form
                                                        action="{{ route(
                                                            'etudiant.documents.destroy',
                                                            [
                                                                'idDemande' => $demande->idDemande,
                                                                'idDocument' => $document->idDocument
                                                            ]
                                                        ) }}"
                                                        method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce document ? Cette action est irréversible.');">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="btn btn-sm btn-outline-danger">

                                                            <i class="bi bi-trash me-1"></i>

                                                            Supprimer

                                                        </button>

                                                    </form>


                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        {{-- =================================================
                             AUCUN DOCUMENT POUR CETTE DEMANDE
                        ================================================== --}}

                        <div class="text-center py-4">

                            <i
                                class="bi bi-file-earmark-x text-muted"
                                style="font-size: 2.5rem;">
                            </i>

                            <p class="text-muted mt-2 mb-3">

                                Aucun document ajouté pour cette demande.

                            </p>

                            <a
                                href="{{ route(
                                    'etudiant.demandes.documents',
                                    [
                                        'idDemande' => $demande->idDemande
                                    ]
                                ) }}"
                                class="btn btn-sm btn-outline-primary">

                                <i class="bi bi-upload me-1"></i>

                                Ajouter un document

                            </a>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                     PIED DE LA CARTE
                ================================================== --}}

                <div class="card-footer bg-light border-0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <small class="text-muted">

                            <i class="bi bi-file-earmark me-1"></i>

                            {{ $demande->documents ? $demande->documents->count() : 0 }}

                            document(s)

                        </small>


                        {{-- =================================================
                             SEULEMENT : VOIR LA DEMANDE
                             
                             "Gérer les documents" SUPPRIMÉ
                        ================================================== --}}

                        <a
                            href="{{ route(
                                'etudiant.demandes.show',
                                [
                                    'idDemande' => $demande->idDemande
                                ]
                            ) }}"
                            class="btn btn-sm btn-outline-primary">

                            <i class="bi bi-eye me-1"></i>

                            Voir la demande

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection
