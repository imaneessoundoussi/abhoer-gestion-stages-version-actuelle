@extends('layouts.admin')

@section('title', 'Gestion des stages - ABHOER')

@section('page-title', 'Gestion des stages')

@section(
    'page-description',
    'Consultez et suivez les stages affectés aux différents services de l’ABHOER.'
)

@section('content')

<div class="container-fluid px-0">

    {{-- =========================================================
         STATISTIQUES
    ========================================================== --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card">
                <div>
                    <div class="admin-stat-label">Total stages</div>
                    <div class="admin-stat-value">
                        {{ $totalStages }}
                    </div>
                </div>

                <div class="admin-stat-icon blue">
                    <i class="bi bi-briefcase"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card">
                <div>
                    <div class="admin-stat-label">Stages en cours</div>
                    <div class="admin-stat-value">
                        {{ $stagesEnCours }}
                    </div>
                </div>

                <div class="admin-stat-icon green">
                    <i class="bi bi-play-circle"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card">
                <div>
                    <div class="admin-stat-label">Stages à venir</div>
                    <div class="admin-stat-value">
                        {{ $stagesAVenir }}
                    </div>
                </div>

                <div class="admin-stat-icon orange">
                    <i class="bi bi-calendar-event"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card">
                <div>
                    <div class="admin-stat-label">Stages terminés</div>
                    <div class="admin-stat-value">
                        {{ $stagesTermines }}
                    </div>
                </div>

                <div class="admin-stat-icon purple">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>

    </div>


    {{-- =========================================================
         RECHERCHE
    ========================================================== --}}

    <div class="admin-card mb-4">

        <div class="admin-card-header">
            <div>
                <h5>Rechercher un stage</h5>
                <p>
                    Recherchez par candidat, demande, thème ou service.
                </p>
            </div>
        </div>

        <div class="admin-card-body">

            <form method="GET" action="{{ route('admin.stages.index') }}">

                <div class="row g-3">

                    <div class="col-md-9">

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Nom, prénom, numéro de demande, thème..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>

                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            <i class="bi bi-search me-1"></i>
                            Rechercher
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
         TABLEAU
    ========================================================== --}}

    <div class="admin-card">

        <div class="admin-card-header">

            <div>
                <h5>Liste des stages</h5>

                <p>
                    {{ $stages->total() }}
                    stage(s) trouvé(s)
                </p>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table admin-table align-middle mb-0">

                <thead>

                    <tr>
                        <th>Stage</th>
                        <th>Candidat</th>
                        <th>Service</th>
                        <th>Période</th>
                        <th>Statut</th>
                        <th class="text-end">Action</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($stages as $stage)

                    @php

                        $today = \Carbon\Carbon::today();

                        $dateDebut = $stage->dateDebut
                            ? \Carbon\Carbon::parse($stage->dateDebut)
                            : null;

                        $dateFin = $stage->dateFin
                            ? \Carbon\Carbon::parse($stage->dateFin)
                            : null;

                        if ($dateDebut && $dateDebut->isFuture()) {
                            $statutStage = 'À venir';
                            $badgeClass = 'warning';
                            $icon = 'calendar-event';
                        } elseif (
                            $dateDebut &&
                            $dateFin &&
                            $today->between($dateDebut, $dateFin)
                        ) {
                            $statutStage = 'En cours';
                            $badgeClass = 'success';
                            $icon = 'play-circle';
                        } elseif ($dateFin && $dateFin->isPast()) {
                            $statutStage = 'Terminé';
                            $badgeClass = 'secondary';
                            $icon = 'check-circle';
                        } else {
                            $statutStage = 'Non défini';
                            $badgeClass = 'secondary';
                            $icon = 'question-circle';
                        }

                    @endphp

                    <tr>

                        <td>

                            <div class="fw-bold">
                                {{ $stage->numeroDemande }}
                            </div>

                            <small class="text-muted">
                                Affectation #{{ $stage->idAffectation }}
                            </small>

                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $stage->prenom }}
                                {{ $stage->nom }}
                            </div>

                            <small class="text-muted">
                                {{ $stage->email }}
                            </small>

                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $stage->nomService }}
                            </div>

                            <small class="text-muted">
                                {{ $stage->nomDepartement }}
                            </small>

                        </td>

                        <td>

                            @if($stage->dateDebut && $stage->dateFin)

                                <div>
                                    Du
                                    <strong>
                                        {{ \Carbon\Carbon::parse($stage->dateDebut)->format('d/m/Y') }}
                                    </strong>
                                </div>

                                <div>
                                    au
                                    <strong>
                                        {{ \Carbon\Carbon::parse($stage->dateFin)->format('d/m/Y') }}
                                    </strong>
                                </div>

                            @else

                                <span class="text-muted">
                                    Non renseignée
                                </span>

                            @endif

                        </td>

                        <td>

                            <span class="badge bg-{{ $badgeClass }}">
                                <i class="bi bi-{{ $icon }} me-1"></i>
                                {{ $statutStage }}
                            </span>

                        </td>

                        <td class="text-end">

                            <a
                                href="{{ route('admin.stages.show', $stage->idAffectation) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                <i class="bi bi-eye"></i>
                                Voir
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <i
                                    class="bi bi-briefcase"
                                    style="font-size: 40px;"
                                ></i>

                                <p class="mt-3 mb-0">
                                    Aucun stage trouvé.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($stages->hasPages())

            <div class="p-3 border-top">

                {{ $stages->links() }}

            </div>

        @endif

    </div>

</div>

@endsection