@extends('layouts.etudiant')

@section('title', 'Mes documents')

@section('page-title', 'Mes documents')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}

    <div class="mb-4">

        <h2 class="fw-bold mb-1">
            Mes documents
        </h2>

        <p class="text-secondary mb-0">
            Consultez les documents associés à vos demandes de stage.
        </p>

    </div>


    {{-- MESSAGE ERREUR --}}

    @if(session('error'))

        <div class="alert alert-danger mb-4">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- MESSAGE SUCCÈS --}}

    @if(session('success'))

        <div class="alert alert-success mb-4">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- AUCUNE DEMANDE --}}

    @if($demandes->isEmpty())

        <div class="dashboard-card">

            <div class="p-5 text-center">

                <i
                    class="bi bi-folder2-open"
                    style="font-size:48px;color:#94a3b8;"
                ></i>

                <h4 class="fw-bold mt-3">
                    Aucun document
                </h4>

                <p class="text-secondary">
                    Vous n'avez encore aucune demande de stage.
                </p>

                <a
                    href="{{ route('etudiant.demande.create') }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Nouvelle demande
                </a>

            </div>

        </div>

    @else


        {{-- DEMANDES --}}

        @foreach($demandes as $demande)

            <div class="dashboard-card mb-4">


                {{-- HEADER --}}

                <div class="p-4 border-bottom">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <a
                                href="{{ route(
                                    'etudiant.demande.show',
                                    [
                                        'idDemande' => $demande->idDemande
                                    ]
                                ) }}"
                                class="fw-bold text-primary text-decoration-none"
                            >

                                {{ $demande->numeroDemande }}

                            </a>


                            <div class="text-secondary small mt-1">

                                {{ $demande->service->nomService ?? 'Service non défini' }}

                            </div>

                        </div>


                        {{-- STATUT --}}

                        @if($demande->statut === 'EN_ATTENTE')

                            <span class="badge bg-warning text-dark">
                                En attente
                            </span>

                        @elseif($demande->statut === 'ACCEPTEE')

                            <span class="badge bg-success">
                                Acceptée
                            </span>

                        @elseif($demande->statut === 'REFUSEE')

                            <span class="badge bg-danger">
                                Refusée
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ $demande->statut }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- CONTENU --}}

                <div class="p-4">


                    {{-- AUCUN DOCUMENT --}}

                    @if($demande->documents->isEmpty())

                        <div class="alert alert-warning">

                            <i class="bi bi-exclamation-triangle me-2"></i>

                            Aucun document n'est associé à cette demande.

                        </div>


                        <a
                            href="{{ route(
                                'etudiant.demande.documents',
                                [
                                    'idDemande' =>
                                        $demande->idDemande
                                ]
                            ) }}"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-upload me-1"></i>

                            Ajouter les documents

                        </a>


                    @else


                        {{-- TITRE --}}

                        <div class="mb-3">

                            <h6 class="fw-bold mb-1">

                                <i class="bi bi-files me-2"></i>

                                Pièces justificatives

                            </h6>

                            <small class="text-secondary">

                                {{ $demande->documents->count() }}
                                document(s)

                            </small>

                        </div>


                        {{-- LISTE --}}

                        <div class="list-group">

                            @foreach($demande->documents as $document)

                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >

                                    <div class="d-flex align-items-center">

                                        {{-- ICÔNE --}}

                                        <div class="me-3">

                                            @if(
                                                strtolower(
                                                    $document->typeDocument
                                                ) === 'cin'
                                            )

                                                <i
                                                    class="bi bi-person-vcard fs-4 text-primary"
                                                ></i>

                                            @elseif(
                                                strtolower(
                                                    $document->typeDocument
                                                ) === 'cv'
                                            )

                                                <i
                                                    class="bi bi-file-person fs-4 text-primary"
                                                ></i>

                                            @elseif(
                                                strtolower(
                                                    $document->typeDocument
                                                ) === 'assurance'
                                            )

                                                <i
                                                    class="bi bi-shield-check fs-4 text-primary"
                                                ></i>

                                            @else

                                                <i
                                                    class="bi bi-file-earmark-text fs-4 text-primary"
                                                ></i>

                                            @endif

                                        </div>


                                        {{-- INFORMATIONS --}}

                                        <div>

                                            <div class="fw-semibold">

                                                {{ $document->typeDocument }}

                                            </div>

                                            <small class="text-secondary">

                                                {{ $document->nomFichier }}

                                            </small>

                                        </div>

                                    </div>


                                    {{-- BOUTON VOIR --}}

                                    @if($document->cheminFichier)

                                        <a
                                            href="{{ asset(
                                                'storage/' .
                                                $document->cheminFichier
                                            ) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary"
                                        >

                                            <i class="bi bi-eye me-1"></i>

                                            Voir

                                        </a>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        @endforeach

    @endif

</div>

@endsection