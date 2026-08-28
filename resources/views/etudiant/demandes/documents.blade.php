@extends('layouts.etudiant')

@section('page-title', 'Documents de la demande')

@section('content')

<div class="container-fluid py-4">

    {{-- ============================================================
         EN-TÊTE
    ============================================================ --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Documents de la demande
            </h2>

            <p class="text-muted mb-0">

                Demande :
                <strong>
                    {{ $demande->numeroDemande }}
                </strong>

            </p>

        </div>


        <a
            href="{{ route('etudiant.demandes.show', [
                'idDemande' => $demande->idDemande
            ]) }}"
            class="btn btn-outline-secondary"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour

        </a>

    </div>


    {{-- ============================================================
         MESSAGES
    ============================================================ --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ============================================================
         INFORMATIONS DEMANDE
    ============================================================ --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <small class="text-muted">
                        Numéro de demande
                    </small>

                    <div class="fw-semibold">
                        {{ $demande->numeroDemande }}
                    </div>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Service
                    </small>

                    <div class="fw-semibold">
                        {{ $demande->service->nomService ?? '—' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Nombre de documents
                    </small>

                    <div class="fw-semibold">

                        {{ $documents->count() }} / 4

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
         DOCUMENTS
    ============================================================ --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-files me-2"></i>

                Documents déposés

            </h5>

        </div>


        <div class="card-body">

            @if($documents->isEmpty())

                <div class="text-center py-5">

                    <i class="bi bi-file-earmark-x display-4 text-muted"></i>

                    <h5 class="mt-3">
                        Aucun document
                    </h5>

                    <p class="text-muted">
                        Aucun document n'a encore été ajouté à cette demande.
                    </p>

                </div>

            @else

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Nom du fichier
                                </th>

                                <th>
                                    Date d'ajout
                                </th>

                                <th class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($documents as $document)

                                <tr>

                                    <td>

                                        <span class="badge text-bg-primary">

                                            <i class="bi bi-file-earmark me-1"></i>

                                            {{ $document->typeDocument }}

                                        </span>

                                    </td>


                                    <td>

                                        <div class="fw-semibold">

                                            {{ $document->nomFichier }}

                                        </div>

                                    </td>


                                    <td>

                                        {{ $document->dateAjout ?? '—' }}

                                    </td>


                                    <td class="text-end">

                                        <div class="btn-group">

                                            {{-- VOIR --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.documents.voir',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande,
                                                        'idDocument' =>
                                                            $document->idDocument
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Voir le document"
                                            >

                                                <i class="bi bi-eye"></i>

                                                Voir

                                            </a>


                                            {{-- TÉLÉCHARGER --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.documents.telecharger',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande,
                                                        'idDocument' =>
                                                            $document->idDocument
                                                    ]
                                                ) }}"
                                                class="btn btn-sm btn-outline-success"
                                                title="Télécharger"
                                            >

                                                <i class="bi bi-download"></i>

                                            </a>


                                            {{-- SUPPRIMER --}}

                                            @php

                                                $statut = strtoupper(
                                                    (string) $demande->statut
                                                );

                                                $peutSupprimer =
                                                    in_array(
                                                        $statut,
                                                        [
                                                            'EN_ATTENTE',
                                                            'BROUILLON'
                                                        ],
                                                        true
                                                    );

                                            @endphp


                                            @if($peutSupprimer)

                                                <form
                                                    action="{{ route(
                                                        'etudiant.demandes.documents.destroy',
                                                        [
                                                            'idDemande' =>
                                                                $demande->idDemande,
                                                            'idDocument' =>
                                                                $document->idDocument
                                                        ]
                                                    ) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm(
                                                        'Voulez-vous vraiment supprimer ce document ?'
                                                    );"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Supprimer"
                                                    >

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection