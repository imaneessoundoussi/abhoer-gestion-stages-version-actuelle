@extends('layouts.admin')

@section('page-title', 'Gestion des départements')

@section('page-description')
    Consultez et gérez les départements de l'ABHOER.
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">
            <i class="bi bi-building me-2"></i>
            Liste des départements
        </h3>

        <p class="text-muted mb-0">
            {{ $departements->count() }} département(s) enregistré(s)
        </p>
    </div>

    <a href="{{ route('admin.departements.create') }}"
       class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>
        Ajouter un département
    </a>
</div>

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

@if($departements->count() > 0)

    <div class="row g-4">

        @foreach($departements as $departement)

            <div class="col-12 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                    style="
                                        width: 48px;
                                        height: 48px;
                                        background: #e7f5f4;
                                        color: #176f78;
                                    "
                                >
                                    <i class="bi bi-building fs-4"></i>
                                </div>

                                <div>
                                    <h5 class="fw-bold mb-1">
                                        {{ $departement->nomDepartement }}
                                    </h5>

                                    <small class="text-muted">
                                        Département #{{ $departement->idDepartement }}
                                    </small>
                                </div>

                            </div>

                            <span class="badge text-bg-light">
                                {{ $departement->services_count }}
                                service(s)
                            </span>

                        </div>

                        <p class="text-muted mb-4">
                            {{ $departement->description ?: 'Aucune description disponible.' }}
                        </p>

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('admin.departements.edit', $departement->idDepartement) }}"
                                class="btn btn-outline-primary btn-sm"
                            >
                                <i class="bi bi-pencil me-1"></i>
                                Modifier
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.departements.destroy', $departement->idDepartement) }}"
                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce département ?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                >
                                    <i class="bi bi-trash me-1"></i>
                                    Supprimer
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">

            <i class="bi bi-building fs-1 text-muted"></i>

            <h5 class="mt-3">
                Aucun département
            </h5>

            <p class="text-muted">
                Aucun département n'est actuellement enregistré.
            </p>

            <a
                href="{{ route('admin.departements.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Ajouter un département
            </a>

        </div>
    </div>

@endif

@endsection