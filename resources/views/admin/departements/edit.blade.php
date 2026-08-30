@extends('layouts.admin')

@section('page-title', 'Modifier un département')

@section('page-description')
    Modifiez les informations du département sélectionné.
@endsection

@section('content')

<div class="row justify-content-center">

    <div class="col-12 col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4 p-lg-5">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="rounded-3 d-flex align-items-center justify-content-center me-3"
                        style="
                            width: 50px;
                            height: 50px;
                            background: #e7f5f4;
                            color: #176f78;
                        "
                    >
                        <i class="bi bi-pencil-square fs-4"></i>
                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Modifier le département
                        </h4>

                        <p class="text-muted mb-0">
                            Département #{{ $departement->idDepartement }}
                        </p>

                    </div>

                </div>

                @if($errors->any())

                    <div class="alert alert-danger border-0">

                        <strong>
                            Veuillez corriger les erreurs suivantes :
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('admin.departements.update', $departement->idDepartement) }}"
                >

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label
                            for="nomDepartement"
                            class="form-label fw-semibold"
                        >
                            Nom du département
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="nomDepartement"
                            name="nomDepartement"
                            class="form-control form-control-lg @error('nomDepartement') is-invalid @enderror"
                            value="{{ old('nomDepartement', $departement->nomDepartement) }}"
                            required
                        >

                        @error('nomDepartement')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label
                            for="description"
                            class="form-label fw-semibold"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description', $departement->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="d-flex justify-content-between">

                        <a
                            href="{{ route('admin.departements.index') }}"
                            class="btn btn-light border"
                        >
                            <i class="bi bi-arrow-left me-1"></i>
                            Retour
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-lg me-1"></i>
                            Enregistrer les modifications
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection