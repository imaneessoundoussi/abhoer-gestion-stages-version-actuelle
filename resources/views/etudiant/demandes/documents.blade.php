@extends('layouts.etudiant')

@section('page-title', 'Documents de la demande')

@section('content')

<div class="container-fluid py-4">

{{-- ============================================================
     EN-TÊTE
============================================================ --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Documents de la demande
        </h2>

        <p class="text-muted mb-0">
            Demande :
            <strong>{{ $demande->numeroDemande }}</strong>
        </p>
    </div>

    <a
        href="{{ route('etudiant.demandes.show', [
            'idDemande' => $demande->idDemande
        ]) }}"
        class="btn btn-outline-secondary"
    >
        <i class="bi bi-arrow-left me-1"></i>
        Retour
    </a>

</div>


{{-- ============================================================
     MESSAGES
============================================================ --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

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

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

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
     ERREURS DE VALIDATION
============================================================ --}}

@if($errors->any())

    <div class="alert alert-danger">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Veuillez corriger les erreurs suivantes :
        </div>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- ============================================================
     INFORMATIONS DEMANDE
============================================================ --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <div class="row g-3">

            {{-- NUMERO --}}

            <div class="col-md-4">

                <small class="text-muted">
                    Numéro de demande
                </small>

                <div class="fw-semibold">
                    {{ $demande->numeroDemande }}
                </div>

            </div>


            {{-- SERVICE --}}

            <div class="col-md-4">

                <small class="text-muted">
                    Service
                </small>

                <div class="fw-semibold">
                    {{ $demande->service->nomService ?? '—' }}
                </div>

            </div>


            {{-- NOMBRE DOCUMENTS --}}

            <div class="col-md-4">

                <small class="text-muted">
                    Nombre de documents
                </small>

                <div class="fw-semibold">

                    @php
                        $nombreDocuments = $documents->count();
                    @endphp

                    <span class="
                        {{ $nombreDocuments >= 4
                            ? 'text-success'
                            : 'text-warning'
                        }}
                    ">
                        {{ $nombreDocuments }} / 4
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================
     ÉTAPE 2
============================================================ --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <h5 class="mb-1 fw-bold">
            <i class="bi bi-cloud-arrow-up me-2"></i>
            Étape 2 — Déposer vos documents
        </h5>

        <small class="text-muted">
            Les quatre documents suivants sont obligatoires.
        </small>

    </div>


    <div class="card-body">

        <div class="alert alert-info">

            <i class="bi bi-info-circle me-2"></i>

            Formats acceptés :
            <strong>PDF, JPG, JPEG et PNG</strong>.
            Taille maximale :
            <strong>5 Mo par fichier</strong>.

        </div>


        {{-- ====================================================
             FORMULAIRE
        ===================================================== --}}

        <form
            action="{{ route('etudiant.demandes.documents.store', [
                'idDemande' => $demande->idDemande
            ]) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="row g-4">


                {{-- =================================================
                     CIN
                ================================================== --}}

                <div class="col-md-6">

                    <div class="border rounded p-4 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class="me-3">

                                <i class="bi bi-person-vcard fs-2 text-primary"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    CIN
                                </h6>

                                <small class="text-muted">
                                    Carte Nationale d'Identité
                                </small>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="documents[0][type]"
                            value="CIN"
                        >

                        <label class="form-label fw-semibold">
                            Fichier CIN
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="documents[0][fichier]"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required
                        >

                        @error('documents.0.fichier')

                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     DEMANDE DE STAGE
                ================================================== --}}

                <div class="col-md-6">

                    <div class="border rounded p-4 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class="me-3">

                                <i class="bi bi-file-earmark-text fs-2 text-primary"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Demande de stage
                                </h6>

                                <small class="text-muted">
                                    Demande de stage signée
                                </small>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="documents[1][type]"
                            value="Demande de stage"
                        >

                        <label class="form-label fw-semibold">
                            Fichier de demande
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="documents[1][fichier]"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required
                        >

                        @error('documents.1.fichier')

                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     ASSURANCE
                ================================================== --}}

                <div class="col-md-6">

                    <div class="border rounded p-4 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class="me-3">

                                <i class="bi bi-shield-check fs-2 text-primary"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Assurance
                                </h6>

                                <small class="text-muted">
                                    Attestation d'assurance
                                </small>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="documents[2][type]"
                            value="Assurance"
                        >

                        <label class="form-label fw-semibold">
                            Fichier d'assurance
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="documents[2][fichier]"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required
                        >

                        @error('documents.2.fichier')

                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     CV
                ================================================== --}}

                <div class="col-md-6">

                    <div class="border rounded p-4 h-100">

                        <div class="d-flex align-items-center mb-3">

                            <div class="me-3">

                                <i class="bi bi-file-earmark-person fs-2 text-primary"></i>

                            </div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    CV
                                </h6>

                                <small class="text-muted">
                                    Curriculum Vitae
                                </small>

                            </div>

                        </div>


                        <input
                            type="hidden"
                            name="documents[3][type]"
                            value="CV"
                        >

                        <label class="form-label fw-semibold">
                            Fichier CV
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="file"
                            name="documents[3][fichier]"
                            class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png"
                            required
                        >

                        @error('documents.3.fichier')

                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 BOUTON
            ===================================================== --}}

            <div class="d-flex justify-content-end mt-4">

                <button
                    type="submit"
                    class="btn btn-primary px-4"
                >

                    <i class="bi bi-cloud-arrow-up me-2"></i>

                    Enregistrer les documents

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ============================================================
     DOCUMENTS DÉJÀ DÉPOSÉS
============================================================ --}}

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">

        <h5 class="mb-0 fw-bold">

            <i class="bi bi-files me-2"></i>

            Documents déposés

        </h5>

    </div>


    <div class="card-body">

        @if($documents->isEmpty())

            <div class="text-center py-5">

                <i
                    class="bi bi-file-earmark-x display-4 text-muted"
                ></i>

                <h5 class="mt-3">
                    Aucun document
                </h5>

                <p class="text-muted mb-0">
                    Aucun document n'a encore été ajouté à cette demande.
                </p>

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Type
                            </th>

                            <th>
                                Nom du fichier
                            </th>

                            <th>
                                Date d'ajout
                            </th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($documents as $document)

                            <tr>

                                {{-- TYPE --}}

                                <td>

                                    <span class="badge text-bg-primary">

                                        <i class="bi bi-file-earmark me-1"></i>

                                        {{ $document->typeDocument }}

                                    </span>

                                </td>


                                {{-- NOM --}}

                                <td>

                                    <div class="fw-semibold">

                                        {{ $document->nomFichier }}

                                    </div>

                                </td>


                                {{-- DATE --}}

                                <td>

                                    @if(!empty($document->dateAjout))

                                        {{ \Carbon\Carbon::parse($document->dateAjout)->format('d/m/Y H:i') }}

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td class="text-end">

                                    <div class="btn-group">


                                        {{-- VOIR --}}

                                        <a
                                            href="{{ route(
                                                'etudiant.demandes.documents.voir',
                                                [
                                                    'idDemande' => $demande->idDemande,
                                                    'idDocument' => $document->idDocument
                                                ]
                                            ) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Voir"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- TÉLÉCHARGER --}}

                                        <a
                                            href="{{ route(
                                                'etudiant.demandes.documents.telecharger',
                                                [
                                                    'idDemande' => $demande->idDemande,
                                                    'idDocument' => $document->idDocument
                                                ]
                                            ) }}"
                                            class="btn btn-sm btn-outline-success"
                                            title="Télécharger"
                                        >

                                            <i class="bi bi-download"></i>

                                        </a>


                                        {{-- SUPPRIMER --}}

                                        <form
                                            action="{{ route(
                                                'etudiant.demandes.documents.destroy',
                                                [
                                                    'idDemande' => $demande->idDemande,
                                                    'idDocument' => $document->idDocument
                                                ]
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce document ?');"
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

        @endif

    </div>

</div>


</div>

@endsection
