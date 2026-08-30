@extends('layouts.admin')

@section('title', 'Journal des activités - ABHOER')

@section('page-title', 'Journal des activités')

@section(
    'page-description',
    'Consultez l’historique des actions effectuées sur la plateforme.'
)

@section('content')

<div class="container-fluid px-0">

    <div class="admin-card mb-4">

        <div class="admin-card-header">

            <div>
                <h5>Journal des activités</h5>

                <p>
                    {{ $totalActions }}
                    action(s) enregistrée(s)
                </p>
            </div>

        </div>

        <div class="admin-card-body">

            <form method="GET">

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Rechercher une action, un utilisateur ou une demande..."
                        value="{{ request('search') }}"
                    >

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Rechercher
                    </button>

                </div>

            </form>

        </div>

    </div>


    <div class="admin-card">

        <div class="table-responsive">

            <table class="table admin-table align-middle mb-0">

                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                        <th>Demande</th>
                        <th>Modification</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($historiques as $historique)

                    <tr>

                        <td>

                            <div class="fw-semibold">

                                @if($historique->dateAction)

                                    {{ \Carbon\Carbon::parse($historique->dateAction)->format('d/m/Y') }}

                                @endif

                            </div>

                            <small class="text-muted">

                                @if($historique->dateAction)

                                    {{ \Carbon\Carbon::parse($historique->dateAction)->format('H:i') }}

                                @endif

                            </small>

                        </td>


                        <td>

                            @if($historique->utilisateurNom)

                                <div class="fw-semibold">

                                    {{ $historique->utilisateurPrenom }}
                                    {{ $historique->utilisateurNom }}

                                </div>

                                <small class="text-muted">

                                    {{ $historique->utilisateurRole }}

                                </small>

                            @else

                                <span class="text-muted">
                                    Système
                                </span>

                            @endif

                        </td>


                        <td>

                            <span class="badge bg-primary">

                                <i class="bi bi-activity me-1"></i>

                                {{ $historique->action }}

                            </span>

                        </td>


                        <td>

                            @if($historique->numeroDemande)

                                <a
                                    href="{{ route(
                                        'admin.demandes.show',
                                        $historique->idDemande
                                    ) }}"
                                    class="fw-semibold text-decoration-none"
                                >
                                    {{ $historique->numeroDemande }}
                                </a>

                            @else

                                <span class="text-muted">
                                    —
                                </span>

                            @endif

                        </td>


                        <td>

                            @if($historique->ancienneValeur || $historique->nouvelleValeur)

                                <div class="small">

                                    @if($historique->ancienneValeur)

                                        <div class="text-muted">
                                            Avant :
                                            {{ $historique->ancienneValeur }}
                                        </div>

                                    @endif

                                    @if($historique->nouvelleValeur)

                                        <div class="fw-semibold">
                                            Après :
                                            {{ $historique->nouvelleValeur }}
                                        </div>

                                    @endif

                                </div>

                            @else

                                <span class="text-muted">
                                    —
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center py-5"
                        >

                            <i
                                class="bi bi-journal-text"
                                style="font-size:40px;"
                            ></i>

                            <p class="text-muted mt-3 mb-0">
                                Aucune activité enregistrée.
                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        @if($historiques->hasPages())

            <div class="p-3 border-top">

                {{ $historiques->links() }}

            </div>

        @endif

    </div>

</div>

@endsection