@extends('layouts.admin')

@section('page-title', 'Détail de la demande')

@section('page-description')
    Consultez toutes les informations relatives à cette demande de stage.
@endsection

@section('content')

<div class="container-fluid px-0">

    {{-- Retour --}}
    <div class="mb-4">

        <a
            href="{{ route('admin.demandes.index') }}"
            class="btn btn-light border"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Retour aux demandes
        </a>

    </div>


    {{-- En-tête --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">

                <div>

                    <div class="text-muted small mb-2">
                        Numéro de demande
                    </div>

                    <h3 class="fw-bold mb-1">
                        {{ $demande->numeroDemande }}
                    </h3>

                    <div class="text-muted">
                        Demande #{{ $demande->idDemande }}
                    </div>

                </div>


                <div>

                    @switch($demande->statut)

                        @case('EN_ATTENTE')

                            <span class="badge bg-warning-subtle text-warning-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-hourglass-split me-1"></i>
                                En attente
                            </span>

                            @break

                        @case('EN_COURS')

                            <span class="badge bg-info-subtle text-info-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-arrow-repeat me-1"></i>
                                En cours d'étude
                            </span>

                            @break

                        @case('ACCEPTEE')

                            <span class="badge bg-success-subtle text-success-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>
                                Acceptée
                            </span>

                            @break

                        @case('REFUSEE')

                            <span class="badge bg-danger-subtle text-danger-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-x-circle me-1"></i>
                                Refusée
                            </span>

                            @break

                        @case('STAGE_EN_COURS')

                            <span class="badge bg-primary-subtle text-primary-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-play-circle me-1"></i>
                                Stage en cours
                            </span>

                            @break

                        @case('TERMINEE')

                            <span class="badge bg-secondary-subtle text-secondary-emphasis fs-6 px-3 py-2">
                                <i class="bi bi-check2-all me-1"></i>
                                Terminée
                            </span>

                            @break

                        @default

                            <span class="badge bg-light text-dark border fs-6 px-3 py-2">
                                {{ $demande->statut ?? 'Non défini' }}
                            </span>

                    @endswitch

                </div>

            </div>

        </div>

    </div>


    <div class="row g-4">


        {{-- Informations candidat --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person me-2 text-primary"></i>
                        Informations du candidat
                    </h5>

                </div>


                <div class="card-body">

                    @if($demande->candidat)

                        <div class="mb-4">

                            <div class="text-muted small">
                                Nom complet
                            </div>

                            <div class="fw-semibold fs-5">
                                {{ $demande->candidat->prenom }}
                                {{ $demande->candidat->nom }}
                            </div>

                        </div>


                        <div class="row g-3">

                            <div class="col-md-6">

                                <div class="text-muted small">
                                    CIN
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->cin ?? 'Non renseignée' }}
                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="text-muted small">
                                    Téléphone
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->telephone ?? 'Non renseigné' }}
                                </div>

                            </div>


                            <div class="col-12">

                                <div class="text-muted small">
                                    Email
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->email ?? 'Non renseigné' }}
                                </div>

                            </div>


                            <div class="col-12">

                                <div class="text-muted small">
                                    Établissement
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->etablissement ?? 'Non renseigné' }}
                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="text-muted small">
                                    Formation
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->formation ?? 'Non renseignée' }}
                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="text-muted small">
                                    Niveau d'étude
                                </div>

                                <div class="fw-semibold">
                                    {{ $demande->candidat->niveauEtude ?? 'Non renseigné' }}
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="alert alert-warning mb-0">
                            Candidat introuvable.
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Informations stage --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-briefcase me-2 text-primary"></i>
                        Informations du stage
                    </h5>

                </div>


                <div class="card-body">

                    <div class="mb-4">

                        <div class="text-muted small">
                            Service demandé
                        </div>

                        @if($demande->service)

                            <div class="fw-semibold fs-5">
                                {{ $demande->service->nomService }}
                            </div>

                        @else

                            <div class="text-muted">
                                Service introuvable
                            </div>

                        @endif

                    </div>


                    @if($demande->service && $demande->service->departement)

                        <div class="mb-4">

                            <div class="text-muted small">
                                Département
                            </div>

                            <div class="fw-semibold">
                                {{ $demande->service->departement->nomDepartement }}
                            </div>

                        </div>

                    @endif


                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="text-muted small">
                                Date de début
                            </div>

                            <div class="fw-semibold">

                                @if($demande->dateDebut)

                                    {{ \Carbon\Carbon::parse($demande->dateDebut)->format('d/m/Y') }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Date de fin
                            </div>

                            <div class="fw-semibold">

                                @if($demande->dateFin)

                                    {{ \Carbon\Carbon::parse($demande->dateFin)->format('d/m/Y') }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="text-muted small">
                                Type de dépôt
                            </div>

                            <div class="fw-semibold">
                                {{ $demande->typeDepot ?? 'Non renseigné' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Thème --}}
        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-journal-text me-2 text-primary"></i>
                        Sujet du stage
                    </h5>

                </div>

                <div class="card-body">

                    <p class="mb-0">

                        {{ $demande->theme ?? 'Aucun thème renseigné.' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Motivation --}}
        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-chat-left-text me-2 text-primary"></i>
                        Motivation
                    </h5>

                </div>

                <div class="card-body">

                    <p
                        class="mb-0"
                        style="white-space: pre-line;"
                    >
                        {{ $demande->motivation ?? 'Aucune motivation renseignée.' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Informations administratives --}}
        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>
                        Informations administratives
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-4">

                            <div class="text-muted small">
                                Numéro de demande
                            </div>

                            <div class="fw-semibold">
                                {{ $demande->numeroDemande }}
                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="text-muted small">
                                Date de dépôt
                            </div>

                            <div class="fw-semibold">

                                @if($demande->dateDepot)

                                    {{ \Carbon\Carbon::parse($demande->dateDepot)->format('d/m/Y') }}

                                @else

                                    Non renseignée

                                @endif

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="text-muted small">
                                Type de dépôt
                            </div>

                            <div class="fw-semibold">
                                {{ $demande->typeDepot ?? 'Non renseigné' }}
                            </div>

                        </div>


                        @if($demande->observation)

                            <div class="col-12">

                                <div class="text-muted small mb-1">
                                    Observation
                                </div>

                                <div class="alert alert-light border mb-0">
                                    {{ $demande->observation }}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection