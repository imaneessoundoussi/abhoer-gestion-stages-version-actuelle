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
     MESSAGES
========================================================== --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

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


@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

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

                default => 'secondary',

            };

        @endphp


        {{-- =================================================
             CARTE DEMANDE
        ================================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            {{-- En-tête de la demande --}}

            <div class="card-header bg-white border-0 py-3">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div
                                class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                style="width: 45px; height: 45px;">

                                <i class="bi bi-file-earmark-text text-primary fs-5"></i>

                            </div>

                            <div>

                                <h5 class="fw-bold mb-1">

                                    {{ $demande->numeroDemande }}

                                </h5>

                                <div class="text-muted small">

                                    <i class="bi bi-building me-1"></i>

                                    {{ $demande->service->nomService ?? 'Service non précisé' }}

                                </div>

                            </div>

                        </div>

                    </div>


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

                @if($demande->documents->isEmpty())

                    <div class="text-center py-4">

                        <i
                            class="bi bi-file-earmark-x text-muted"
                            style="font-size: 2.5rem;">
                        </i>

                        <p class="text-muted mt-2 mb-0">

                            Aucun document ajouté pour cette demande.

                        </p>

                    </div>

                @else

                    <div class="row g-3">

                        @foreach($demande->documents as $document)

                            <div class="col-12">

                                <div class="border rounded-3 p-3">

                                    <div class="row align-items-center">

                                        {{-- =================================================
                                             ICÔNE + INFORMATIONS DOCUMENT
                                        ================================================== --}}

                                        <div class="col-md-6">

                                            <div class="d-flex align-items-center">

                                                @php

                                                    $extension = strtolower(
                                                        pathinfo(
                                                            $document->nomFichier ?? '',
                                                            PATHINFO_EXTENSION
                                                        )
                                                    );

                                                    $icone = match($extension) {

                                                        'pdf' => 'bi-file-earmark-pdf',

                                                        'jpg',
                                                        'jpeg',
                                                        'png' => 'bi-file-earmark-image',

                                                        'doc',
                                                        'docx' => 'bi-file-earmark-word',

                                                        default => 'bi-file-earmark',

                                                    };

                                                @endphp


                                                <div
                                                    class="rounded-3 bg-light d-flex align-items-center justify-content-center me-3"
                                                    style="width: 48px; height: 48px;">

                                                    <i
                                                        class="bi {{ $icone }} fs-4 text-primary">
                                                    </i>

                                                </div>


                                                <div style="min-width: 0;">

                                                    <div class="fw-semibold">

                                                        {{ $document->typeDocument }}

                                                    </div>

                                                    <div
                                                        class="text-muted small text-truncate"
                                                        style="max-width: 350px;"
                                                        title="{{ $document->nomFichier }}">

                                                        {{ $document->nomFichier }}

                                                    </div>

                                                    <div class="text-muted small mt-1">

                                                        <i class="bi bi-clock me-1"></i>

                                                        Ajouté le

                                                        {{ $document->dateAjout
                                                            ? \Carbon\Carbon::parse($document->dateAjout)->format('d/m/Y à H:i')
                                                            : '—'
                                                        }}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- =================================================
                                             ACTIONS
                                        ================================================== --}}

                                        <div class="col-md-6">

                                            <div
                                                class="d-flex justify-content-md-end gap-2 mt-3 mt-md-0">

                                                {{-- ===============================
                                                     VOIR
                                                ================================ --}}

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


                                                {{-- ===============================
                                                     TÉLÉCHARGER
                                                ================================ --}}

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


                                                {{-- ===============================
                                                     SUPPRIMER
                                                ================================ --}}

                                                @if(in_array($statut, ['EN_ATTENTE', 'BROUILLON'], true))

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

                                                @else

                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline-secondary"
                                                        disabled
                                                        title="La demande est déjà en cours de traitement.">

                                                        <i class="bi bi-lock me-1"></i>

                                                        Supprimer

                                                    </button>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- =================================================
                 PIED DE LA CARTE
            ================================================== --}}

            <div class="card-footer bg-light border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <small class="text-muted">

                        <i class="bi bi-file-earmark me-1"></i>

                        {{ $demande->documents->count() }}

                        document(s)

                    </small>


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
