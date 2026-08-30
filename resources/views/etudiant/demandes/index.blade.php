@extends('layouts.etudiant')

@section('page-title', 'Mes demandes')

@section('content')

<div class="container-fluid py-4">

    {{-- ============================================================
         EN-TÊTE
    ============================================================ --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Mes demandes de stage
            </h2>

            <p class="text-muted mb-0">
                Consultez, gérez et suivez vos demandes de stage.
            </p>
        </div>

        <a
            href="{{ route('etudiant.demandes.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Nouvelle demande
        </a>

    </div>


    {{-- ============================================================
         MESSAGES
    ============================================================ --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
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

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >
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
         AUCUNE DEMANDE
    ============================================================ --}}

    @if($demandes->isEmpty())

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center py-5">

                <i class="bi bi-folder2-open display-4 text-muted"></i>

                <h5 class="mt-3">
                    Aucune demande
                </h5>

                <p class="text-muted">
                    Vous n'avez pas encore créé de demande de stage.
                </p>

                <a
                    href="{{ route('etudiant.demandes.create') }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Créer une demande
                </a>

            </div>

        </div>

    @else


        {{-- ========================================================
             TABLEAU DES DEMANDES
        ========================================================= --}}

        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-3">
                                    Numéro
                                </th>

                                <th>
                                    Service
                                </th>

                                <th>
                                    Date de dépôt
                                </th>

                                <th>
                                    Stage
                                </th>

                                <th>
                                    Documents
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th class="text-end px-3">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($demandes as $demande)

                                @php

                                    $statut = strtoupper(
                                        $demande->statut ?? ''
                                    );

                                    $badge = match($statut) {

                                        'ACCEPTEE' =>
                                            'success',

                                        'REFUSEE' =>
                                            'danger',

                                        'EN_COURS' =>
                                            'warning',

                                        'EN_ATTENTE' =>
                                            'secondary',

                                        'STAGE_EN_COURS' =>
                                            'primary',

                                        'TERMINEE' =>
                                            'success',

                                        'BROUILLON' =>
                                            'dark',

                                        default =>
                                            'secondary',
                                    };

                                    $nombreDocuments =
                                        $demande->documents->count();

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


                                <tr>

                                    {{-- NUMÉRO --}}

                                    <td class="px-3">

                                        <span class="fw-semibold">
                                            {{ $demande->numeroDemande }}
                                        </span>

                                    </td>


                                    {{-- SERVICE --}}

                                    <td>

                                        {{ $demande->service->nomService ?? '—' }}

                                    </td>


                                    {{-- DATE --}}

                                    <td>

                                        {{ $demande->dateDepot ?? '—' }}

                                    </td>


                                    {{-- STAGE --}}

                                    <td>

                                        {{ $demande->dateDebut ?? '—' }}

                                        <br>

                                        <small class="text-muted">

                                            au
                                            {{ $demande->dateFin ?? '—' }}

                                        </small>

                                    </td>


                                    {{-- DOCUMENTS --}}

                                    <td>

                                        @if($nombreDocuments > 0)

                                            <span class="badge text-bg-success">

                                                <i class="bi bi-file-earmark-check me-1"></i>

                                                {{ $nombreDocuments }}
                                                document{{ $nombreDocuments > 1 ? 's' : '' }}

                                            </span>

                                        @else

                                            <span class="badge text-bg-secondary">

                                                Aucun document

                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUT --}}

                                    <td>

                                        <span
                                            class="badge text-bg-{{ $badge }}"
                                        >
                                            {{ str_replace('_', ' ', $statut) }}
                                        </span>

                                    </td>


                                    {{-- ACTIONS --}}

                                    <td class="text-end px-3">

                                        <div class="btn-group">

                                            {{-- VOIR LA DEMANDE --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.show',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande
                                                    ]
                                                ) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Voir la demande"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- VOIR LES DOCUMENTS --}}

                                            <a
                                                href="{{ route(
                                                    'etudiant.demandes.documents',
                                                    [
                                                        'idDemande' =>
                                                            $demande->idDemande
                                                    ]
                                                ) }}"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Voir les documents"
                                            >

                                                <i class="bi bi-file-earmark-text"></i>

                                            </a>


                                            {{-- SUPPRIMER --}}

                                            @if($peutSupprimer)

                                                <form
                                                    action="{{ route(
                                                        'etudiant.demandes.destroy',
                                                        [
                                                            'idDemande' =>
                                                                $demande->idDemande
                                                        ]
                                                    ) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm(
                                                        'Êtes-vous sûr de vouloir supprimer cette demande ?\\n\\nTous les documents associés seront également supprimés définitivement.'
                                                    );"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Supprimer la demande"
                                                    >

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>

                                            @else

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    disabled
                                                    title="Cette demande ne peut plus être supprimée"
                                                >

                                                    <i class="bi bi-lock"></i>

                                                </button>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection