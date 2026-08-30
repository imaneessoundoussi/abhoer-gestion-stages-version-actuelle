@extends('layouts.admin')

@section('title', 'Détail du stage - ABHOER')

@section('page-title', 'Détail du stage')

@section(
    'page-description',
    'Consultez les informations détaillées concernant ce stage.'
)

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">

        <a
            href="{{ route('admin.stages.index') }}"
            class="btn btn-light"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Retour aux stages
        </a>

    </div>


    <div class="row g-4">

        {{-- Candidat --}}

        <div class="col-lg-6">

            <div class="admin-card h-100">

                <div class="admin-card-header">
                    <div>
                        <h5>
                            <i class="bi bi-person me-2"></i>
                            Informations du candidat
                        </h5>
                    </div>
                </div>

                <div class="admin-card-body">

                    <div class="detail-row">
                        <span>Nom complet</span>
                        <strong>
                            {{ $stage->prenom }}
                            {{ $stage->nom }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>CIN</span>
                        <strong>
                            {{ $stage->cin ?? 'Non renseigné' }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Email</span>
                        <strong>
                            {{ $stage->email }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Téléphone</span>
                        <strong>
                            {{ $stage->telephone ?? 'Non renseigné' }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Établissement</span>
                        <strong>
                            {{ $stage->etablissement ?? 'Non renseigné' }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Formation</span>
                        <strong>
                            {{ $stage->formation ?? 'Non renseignée' }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Niveau</span>
                        <strong>
                            {{ $stage->niveauEtude ?? 'Non renseigné' }}
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Stage --}}

        <div class="col-lg-6">

            <div class="admin-card h-100">

                <div class="admin-card-header">
                    <div>
                        <h5>
                            <i class="bi bi-briefcase me-2"></i>
                            Informations du stage
                        </h5>
                    </div>
                </div>

                <div class="admin-card-body">

                    <div class="detail-row">
                        <span>Numéro demande</span>
                        <strong>
                            {{ $stage->numeroDemande }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Type</span>
                        <strong>
                            {{ $stage->typeDepot }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Service</span>
                        <strong>
                            {{ $stage->nomService }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Département</span>
                        <strong>
                            {{ $stage->nomDepartement }}
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Date d'affectation</span>
                        <strong>
                            @if($stage->dateAffectation)
                                {{ \Carbon\Carbon::parse($stage->dateAffectation)->format('d/m/Y') }}
                            @else
                                Non renseignée
                            @endif
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Date début</span>
                        <strong>
                            @if($stage->dateDebut)
                                {{ \Carbon\Carbon::parse($stage->dateDebut)->format('d/m/Y') }}
                            @else
                                Non renseignée
                            @endif
                        </strong>
                    </div>

                    <div class="detail-row">
                        <span>Date fin</span>
                        <strong>
                            @if($stage->dateFin)
                                {{ \Carbon\Carbon::parse($stage->dateFin)->format('d/m/Y') }}
                            @else
                                Non renseignée
                            @endif
                        </strong>
                    </div>

                </div>

            </div>

        </div>


        {{-- Thème --}}

        <div class="col-12">

            <div class="admin-card">

                <div class="admin-card-header">

                    <h5>
                        <i class="bi bi-file-text me-2"></i>
                        Sujet du stage
                    </h5>

                </div>

                <div class="admin-card-body">

                    <h6 class="fw-bold">
                        {{ $stage->theme }}
                    </h6>

                    @if($stage->motivation)

                        <hr>

                        <h6 class="fw-bold mb-2">
                            Motivation
                        </h6>

                        <p class="text-muted mb-0">
                            {{ $stage->motivation }}
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- Observation --}}

        @if($stage->observation)

            <div class="col-12">

                <div class="admin-card">

                    <div class="admin-card-header">

                        <h5>
                            <i class="bi bi-chat-left-text me-2"></i>
                            Observation
                        </h5>

                    </div>

                    <div class="admin-card-body">

                        <p class="mb-0">
                            {{ $stage->observation }}
                        </p>

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection

@push('styles')

<style>

.detail-row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 13px 0;
    border-bottom: 1px solid #edf0f5;
}

.detail-row:last-child {
    border-bottom: 0;
}

.detail-row span {
    color: #7b8494;
}

.detail-row strong {
    text-align: right;
    color: #172033;
}

</style>

@endpush