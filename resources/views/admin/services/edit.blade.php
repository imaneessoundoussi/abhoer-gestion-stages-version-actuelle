
@extends('layouts.admin')

@section('title', 'Modifier un service - ABHOER')

@section('page-title', 'Modifier un service')

@section('page-description')
    Modifiez les informations du service sélectionné.
@endsection

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4 p-lg-5">

                <div class="d-flex align-items-center mb-4">

                    <div class="bg-primary-subtle text-primary rounded-3 p-3 me-3">

                        <i class="bi bi-pencil-square fs-4"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Modifier le service
                        </h5>

                        <p class="text-muted small mb-0">
                            Service #{{ $service->idService }}
                        </p>

                    </div>

                </div>


                {{-- Erreurs de validation --}}

                @if($errors->any())

                    <div class="alert alert-danger border-0">

                        <div class="fw-bold mb-2">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            Veuillez corriger les erreurs suivantes :

                        </div>

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    action="{{ route('admin.services.update', $service->idService) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- Département --}}

                    <div class="mb-4">

                        <label
                            for="idDepartement"
                            class="form-label fw-semibold"
                        >

                            Département
                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="idDepartement"
                            id="idDepartement"
                            class="form-select @error('idDepartement') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                -- Sélectionner un département --
                            </option>

                            @foreach($departements as $departement)

                                <option
                                    value="{{ $departement->idDepartement }}"
                                    {{ old('idDepartement', $service->idDepartement) == $departement->idDepartement ? 'selected' : '' }}
                                >

                                    {{ $departement->nomDepartement }}

                                </option>

                            @endforeach

                        </select>

                        @error('idDepartement')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Nom du service --}}

                    <div class="mb-4">

                        <label
                            for="nomService"
                            class="form-label fw-semibold"
                        >

                            Nom du service
                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="nomService"
                            id="nomService"
                            value="{{ old('nomService', $service->nomService) }}"
                            class="form-control @error('nomService') is-invalid @enderror"
                            maxlength="255"
                            required
                        >

                        @error('nomService')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Capacité --}}

                    <div class="mb-4">

                        <label
                            for="capaciteAccueil"
                            class="form-label fw-semibold"
                        >

                            Capacité d'accueil
                            <span class="text-danger">*</span>

                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="capaciteAccueil"
                                id="capaciteAccueil"
                                value="{{ old('capaciteAccueil', $service->capaciteAccueil) }}"
                                class="form-control @error('capaciteAccueil') is-invalid @enderror"
                                min="1"
                                required
                            >

                            <span class="input-group-text">
                                stagiaire(s)
                            </span>

                        </div>

                        @error('capaciteAccueil')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="mb-4">

                        <label
                            for="description"
                            class="form-label fw-semibold"
                        >

                            Description

                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Décrivez brièvement les activités du service..."
                        >{{ old('description', $service->description) }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Informations --}}

                    <div class="alert alert-light border mb-4">

                        <div class="d-flex">

                            <i class="bi bi-info-circle text-primary me-2"></i>

                            <div class="small text-muted">

                                <strong>Service :</strong>
                                {{ $service->nomService }}

                                <br>

                                <strong>ID :</strong>
                                {{ $service->idService }}

                            </div>

                        </div>

                    </div>


                    {{-- Boutons --}}

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                        <a
                            href="{{ route('admin.services.index') }}"
                            class="btn btn-outline-secondary"
                        >

                            <i class="bi bi-arrow-left me-1"></i>

                            Annuler

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary px-4"
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
