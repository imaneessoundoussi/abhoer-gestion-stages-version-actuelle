
@extends('layouts.admin')

@section('title', 'Gestion des services - ABHOER')

@section('page-title', 'Gestion des services')

@section('page-description')
    Consultez et gérez les services disponibles pour les stages à l'ABHOER.
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1 fw-bold text-dark">
            Liste des services
        </h5>

        <p class="text-muted mb-0 small">
            {{ $services->count() }} service(s) enregistré(s)
        </p>
    </div>

    <a href="{{ route('admin.services.create') }}"
       class="btn btn-primary px-4">
        <i class="bi bi-plus-lg me-1"></i>
        Ajouter un service
    </a>
</div>


{{-- Messages --}}

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
    </div>
@endif


{{-- Tableau --}}

<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        @if($services->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="px-4">ID</th>
                            <th>Service</th>
                            <th>Département</th>
                            <th class="text-center">Capacité</th>
                            <th>Description</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($services as $service)

                            <tr>

                                {{-- ID --}}

                                <td class="px-4">
                                    <span class="badge bg-light text-dark border">
                                        #{{ $service->idService }}
                                    </span>
                                </td>


                                {{-- Nom du service --}}

                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ $service->nomService }}
                                    </div>
                                </td>


                                {{-- Département --}}

                                <td>

                                    @if($service->departement)

                                        <span class="badge bg-info-subtle text-info-emphasis">
                                            <i class="bi bi-building me-1"></i>
                                            {{ $service->departement->nomDepartement }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Département non défini
                                        </span>

                                    @endif

                                </td>


                                {{-- Capacité --}}

                                <td class="text-center">

                                    <span class="badge bg-primary-subtle text-primary-emphasis">

                                        <i class="bi bi-people me-1"></i>

                                        {{ $service->capaciteAccueil }}

                                    </span>

                                </td>


                                {{-- Description --}}

                                <td>

                                    @if($service->description)

                                        <span class="text-muted small">
                                            {{ $service->description }}
                                        </span>

                                    @else

                                        <span class="text-muted small fst-italic">
                                            Aucune description
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}

                                <td class="text-end px-4">

                                    <div class="d-flex justify-content-end gap-2">

                                        {{-- Modifier --}}

                                        <a href="{{ route('admin.services.edit', $service->idService) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Modifier">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Supprimer --}}

                                        <form
                                            action="{{ route('admin.services.destroy', $service->idService) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?');"
                                            class="d-inline"
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

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center py-5">

                <div class="mb-3">

                    <i class="bi bi-diagram-3 display-4 text-muted"></i>

                </div>

                <h5 class="fw-bold">
                    Aucun service
                </h5>

                <p class="text-muted">
                    Aucun service n'est actuellement enregistré.
                </p>

                <a href="{{ route('admin.services.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-plus-lg me-1"></i>

                    Ajouter le premier service

                </a>

            </div>

        @endif

    </div>

</div>

@endsection
