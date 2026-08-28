
@extends('layouts.etudiant')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

<style>

    /* =========================================================
       DASHBOARD
    ========================================================= */

    .dashboard-wrapper {
        max-width: 1500px;
        margin: 0 auto;
    }


    /* =========================================================
       WELCOME
    ========================================================= */

    .welcome-card {
        position: relative;
        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                #ffffff 0%,
                #f8fbff 100%
            );

        border: 1px solid #e7ebf2;

        border-radius: 18px;

        padding: 28px 30px;

        margin-bottom: 25px;

        box-shadow:
            0 6px 25px
            rgba(20, 33, 61, .045);
    }

    .welcome-card::after {
        content: "";

        position: absolute;

        width: 220px;
        height: 220px;

        right: -80px;
        top: -100px;

        border-radius: 50%;

        background:
            rgba(37, 99, 235, .06);
    }

    .welcome-title {
        position: relative;
        z-index: 2;

        font-size: 25px;

        font-weight: 750;

        color: #172033;

        margin-bottom: 6px;
    }

    .welcome-text {
        position: relative;
        z-index: 2;

        color: #7b8495;

        font-size: 14px;

        margin: 0;
    }


    /* =========================================================
       CANDIDAT
    ========================================================= */

    .candidate-card {
        background: #ffffff;

        border:
            1px solid #e7ebf2;

        border-radius: 16px;

        margin-bottom: 25px;

        box-shadow:
            0 5px 20px
            rgba(20, 33, 61, .04);
    }

    .candidate-avatar {
        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        background:
            #eff6ff;

        color:
            #2563eb;

        font-size: 21px;
    }

    .candidate-name {
        font-size: 16px;
        font-weight: 700;

        color: #172033;
    }

    .candidate-formation {
        color: #7b8495;
        font-size: 13px;
    }


    /* =========================================================
       STATISTICS
    ========================================================= */

    .stat-card {
        height: 100%;

        background: #ffffff;

        border:
            1px solid #e7ebf2;

        border-radius: 16px;

        padding: 22px;

        box-shadow:
            0 5px 20px
            rgba(20, 33, 61, .04);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .stat-card:hover {
        transform:
            translateY(-3px);

        box-shadow:
            0 10px 28px
            rgba(20, 33, 61, .08);
    }

    .stat-content {
        display: flex;

        align-items: center;

        justify-content: space-between;
    }

    .stat-label {
        color: #7b8495;

        font-size: 12px;

        font-weight: 600;

        margin-bottom: 7px;
    }

    .stat-number {
        font-size: 29px;

        font-weight: 800;

        line-height: 1;

        color: #172033;
    }

    .stat-description {
        color: #9aa2b1;

        font-size: 11px;

        margin-top: 8px;
    }

    .stat-icon {
        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        font-size: 21px;
    }

    .stat-primary .stat-icon {
        background: #eff6ff;
        color: #2563eb;
    }

    .stat-warning .stat-icon {
        background: #fff8e6;
        color: #d97706;
    }

    .stat-success .stat-icon {
        background: #ecfdf3;
        color: #16a34a;
    }

    .stat-danger .stat-icon {
        background: #fff1f2;
        color: #dc2626;
    }


    /* =========================================================
       QUICK ACTION
    ========================================================= */

    .quick-action {
        background:
            linear-gradient(
                135deg,
                #14213d 0%,
                #1b2d50 100%
            );

        color: #ffffff;

        border-radius: 17px;

        padding: 25px 28px;

        margin-top: 25px;

        margin-bottom: 25px;

        box-shadow:
            0 10px 28px
            rgba(20, 33, 61, .12);
    }

    .quick-action-title {
        font-size: 17px;

        font-weight: 700;

        margin-bottom: 5px;
    }

    .quick-action-text {
        color:
            rgba(255, 255, 255, .68);

        font-size: 13px;

        margin: 0;
    }

    .quick-action .btn {
        background: #ffffff;

        color: #14213d;

        border: none;

        padding:
            10px 17px;
    }

    .quick-action .btn:hover {
        background: #f4f7fb;

        color: #14213d;

        transform:
            translateY(-1px);
    }


    /* =========================================================
       STAGE EN COURS
    ========================================================= */

    .stage-alert {
        display: flex;

        align-items: center;

        gap: 15px;

        background:
            #ecfdf3;

        border:
            1px solid #bbf7d0;

        border-left:
            4px solid #16a34a;

        border-radius: 14px;

        padding: 18px 20px;

        margin-bottom: 25px;
    }

    .stage-icon {
        width: 46px;
        height: 46px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            #dcfce7;

        color:
            #16a34a;

        border-radius: 12px;

        font-size: 20px;
    }

    .stage-title {
        font-weight: 700;

        color:
            #166534;

        font-size: 14px;

        margin-bottom: 3px;
    }

    .stage-text {
        color:
            #4d7c5b;

        font-size: 12px;

        margin: 0;
    }


    /* =========================================================
       DEMANDES
    ========================================================= */

    .requests-card {
        background: #ffffff;

        border:
            1px solid #e7ebf2;

        border-radius: 17px;

        overflow: hidden;

        box-shadow:
            0 5px 20px
            rgba(20, 33, 61, .04);
    }

    .requests-header {
        display: flex;

        align-items: center;

        justify-content: space-between;

        padding:
            21px 24px;

        border-bottom:
            1px solid #e7ebf2;
    }

    .requests-title {
        font-size: 16px;

        font-weight: 750;

        margin-bottom: 3px;

        color:
            #172033;
    }

    .requests-subtitle {
        font-size: 12px;

        color:
            #7b8495;

        margin: 0;
    }


    /* =========================================================
       REQUEST ITEM
    ========================================================= */

    .request-item {
        padding:
            17px 19px;

        border:
            1px solid #e8ecf2;

        border-radius: 13px;

        margin-bottom: 12px;

        transition:
            all .2s ease;
    }

    .request-item:last-child {
        margin-bottom: 0;
    }

    .request-item:hover {
        background:
            #f8fbff;

        border-color:
            #d6e4f7;

        transform:
            translateX(2px);
    }

    .request-number {
        color:
            #173b67;

        font-size: 14px;

        font-weight: 700;
    }

    .request-number:hover {
        color:
            #2563eb;
    }

    .request-service {
        color:
            #7b8495;

        font-size: 12px;

        margin-top: 5px;
    }

    .request-label {
        display: block;

        color:
            #9aa2b1;

        font-size: 10px;

        text-transform:
            uppercase;

        letter-spacing: .4px;

        margin-bottom: 3px;
    }

    .request-date {
        color:
            #172033;

        font-size: 12px;

        font-weight: 600;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        text-align: center;

        padding:
            55px 20px;
    }

    .empty-icon {
        width: 72px;
        height: 72px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin:
            0 auto 18px;

        border-radius: 20px;

        background:
            #f1f5f9;

        color:
            #94a3b8;

        font-size: 30px;
    }

    .empty-title {
        font-size: 16px;

        font-weight: 700;

        color:
            #172033;

        margin-bottom: 5px;
    }

    .empty-text {
        color:
            #7b8495;

        font-size: 13px;

        margin-bottom: 20px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767px) {

        .welcome-card {
            padding:
                22px;
        }

        .welcome-title {
            font-size: 21px;
        }

        .requests-header {
            padding:
                18px;
        }

        .request-item {
            padding:
                15px;
        }

        .quick-action {
            padding:
                22px;
        }

    }

</style>


<div class="dashboard-wrapper">


    {{-- =========================================================
         BIENVENUE
    ========================================================== --}}

    <div class="welcome-card">

        <h2 class="welcome-title">

            Bonjour
            {{ $user->prenom ?? $user->nom ?? 'Étudiant' }}

            <span>
                👋
            </span>

        </h2>

        <p class="welcome-text">

            Bienvenue dans votre espace étudiant ABHOER.
            Suivez vos demandes et gérez vos stages facilement.

        </p>

    </div>


    {{-- =========================================================
         MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success mb-4">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger mb-4">

            <i class="bi bi-exclamation-triangle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- =========================================================
         INFORMATIONS CANDIDAT
    ========================================================== --}}

    @if($candidat)

        <div class="candidate-card">

            <div class="p-4">

                <div
                    class="d-flex align-items-center justify-content-between gap-3"
                >

                    <div
                        class="d-flex align-items-center gap-3"
                    >

                        <div class="candidate-avatar">

                            <i class="bi bi-person-fill"></i>

                        </div>

                        <div>

                            <div class="candidate-name">

                                {{ $candidat->prenom }}
                                {{ $candidat->nom }}

                            </div>

                            <div class="candidate-formation">

                                {{ $candidat->formation ?? 'Formation non renseignée' }}

                            </div>

                        </div>

                    </div>


                    <a
                        href="{{ route('etudiant.profil') }}"
                        class="btn btn-outline-primary btn-sm"
                    >

                        <i class="bi bi-person me-1"></i>

                        Mon profil

                    </a>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         STATISTIQUES
    ========================================================== --}}

    <div class="row g-4">


        {{-- TOTAL --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-primary">

                <div class="stat-content">

                    <div>

                        <div class="stat-label">
                            MES DEMANDES
                        </div>

                        <div class="stat-number">

                            {{ $totalDemandes ?? 0 }}

                        </div>

                        <div class="stat-description">
                            Demande(s) déposée(s)
                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- EN ATTENTE --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-warning">

                <div class="stat-content">

                    <div>

                        <div class="stat-label">
                            EN ATTENTE
                        </div>

                        <div class="stat-number text-warning">

                            {{ $demandesEnAttente ?? 0 }}

                        </div>

                        <div class="stat-description">
                            En attente de traitement
                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- ACCEPTEES --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-success">

                <div class="stat-content">

                    <div>

                        <div class="stat-label">
                            ACCEPTÉES
                        </div>

                        <div class="stat-number text-success">

                            {{ $demandesAcceptees ?? 0 }}

                        </div>

                        <div class="stat-description">
                            Demande(s) acceptée(s)
                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- REFUSEES --}}
        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-danger">

                <div class="stat-content">

                    <div>

                        <div class="stat-label">
                            REFUSÉES
                        </div>

                        <div class="stat-number text-danger">

                            {{ $demandesRefusees ?? 0 }}

                        </div>

                        <div class="stat-description">
                            Demande(s) refusée(s)
                        </div>

                    </div>

                    <div class="stat-icon">

                        <i class="bi bi-x-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ACTION RAPIDE
    ========================================================== --}}

    <div class="quick-action">

        <div class="row align-items-center">

            <div class="col-md-8">

                <div class="quick-action-title">

                    Vous souhaitez effectuer un stage ?

                </div>

                <p class="quick-action-text">

                    Déposez une nouvelle demande de stage auprès
                    de l'ABHOER et suivez son traitement depuis
                    votre espace étudiant.

                </p>

            </div>


            <div
                class="col-md-4 text-md-end mt-3 mt-md-0"
            >

                <a
                    href="{{ route('etudiant.demandes.create') }}"
                    class="btn"
                >

                    <i class="bi bi-plus-lg me-1"></i>

                    Nouvelle demande

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
         STAGE EN COURS
    ========================================================== --}}

    @if(($stagesEnCours ?? 0) > 0)

        <div class="stage-alert">

            <div class="stage-icon">

                <i class="bi bi-briefcase-fill"></i>

            </div>

            <div>

                <div class="stage-title">

                    Stage en cours

                </div>

                <p class="stage-text">

                    Vous avez actuellement

                    <strong>
                        {{ $stagesEnCours }}
                    </strong>

                    stage(s) en cours.

                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
         DERNIÈRES DEMANDES
    ========================================================== --}}

    <div class="requests-card">

        {{-- HEADER --}}

        <div class="requests-header">

            <div>

                <div class="requests-title">

                    Mes dernières demandes

                </div>

                <p class="requests-subtitle">

                    Consultez l'état de vos demandes de stage.

                </p>

            </div>


            <a
                href="{{ route('etudiant.demandes.index') }}"
                class="btn btn-sm btn-outline-primary"
            >

                Voir tout

                <i class="bi bi-arrow-right ms-1"></i>

            </a>

        </div>


        {{-- CONTENT --}}

        <div class="p-4">

            @forelse(($dernieresDemandes ?? collect()) as $demande)

                <div class="request-item">

                    <div class="row align-items-center">


                        {{-- DEMANDE --}}

                        <div class="col-md-5">

                            <a
                                href="{{ route(
                                    'etudiant.demandes.show',
                                    ['idDemande' => $demande->idDemande]
                                ) }}"
                                class="request-number"
                            >

                                {{ $demande->numeroDemande
                                    ?? 'Demande #' . $demande->idDemande
                                }}

                            </a>


                            <div class="request-service">

                                <i class="bi bi-building me-1"></i>

                                {{ $demande->service->nomService
                                    ?? 'Service non défini'
                                }}

                            </div>

                        </div>


                        {{-- DATE --}}

                        <div class="col-md-3 mt-3 mt-md-0">

                            <span class="request-label">

                                Date de dépôt

                            </span>

                            <span class="request-date">

                                @if($demande->dateDepot)

                                    {{ \Carbon\Carbon::parse(
                                        $demande->dateDepot
                                    )->format('d/m/Y') }}

                                @else

                                    Non renseignée

                                @endif

                            </span>

                        </div>


                        {{-- STATUT --}}

                        <div
                            class="col-md-4 text-md-end mt-3 mt-md-0"
                        >

                            @php

                                $statut = strtoupper(
                                    str_replace(
                                        ' ',
                                        '_',
                                        trim(
                                            $demande->statut ?? ''
                                        )
                                    )
                                );

                            @endphp


                            @if($statut === 'EN_ATTENTE')

                                <span
                                    class="badge bg-warning text-dark"
                                >

                                    <i
                                        class="bi bi-hourglass-split me-1"
                                    ></i>

                                    En attente

                                </span>


                            @elseif(in_array($statut, [
                                'EN_COURS',
                                'EN_COURS_ETUDE',
                                'EN_ETUDE'
                            ], true))

                                <span
                                    class="badge bg-primary"
                                >

                                    <i
                                        class="bi bi-search me-1"
                                    ></i>

                                    En cours d'étude

                                </span>


                            @elseif(in_array($statut, [
                                'ACCEPTEE',
                                'ACCEPTE'
                            ], true))

                                <span
                                    class="badge bg-success"
                                >

                                    <i
                                        class="bi bi-check-circle me-1"
                                    ></i>

                                    Acceptée

                                </span>


                            @elseif(in_array($statut, [
                                'REFUSEE',
                                'REFUSE'
                            ], true))

                                <span
                                    class="badge bg-danger"
                                >

                                    <i
                                        class="bi bi-x-circle me-1"
                                    ></i>

                                    Refusée

                                </span>


                            @elseif($statut === 'STAGE_EN_COURS')

                                <span
                                    class="badge bg-success"
                                >

                                    <i
                                        class="bi bi-briefcase-fill me-1"
                                    ></i>

                                    Stage en cours

                                </span>


                            @else

                                <span
                                    class="badge bg-secondary"
                                >

                                    {{ $demande->statut
                                        ?? 'Non défini'
                                    }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}

                <div class="empty-state">

                    <div class="empty-icon">

                        <i
                            class="bi bi-file-earmark-text"
                        ></i>

                    </div>

                    <div class="empty-title">

                        Aucune demande

                    </div>

                    <p class="empty-text">

                        Vous n'avez encore déposé aucune
                        demande de stage.

                    </p>

                    <a
                        href="{{ route('etudiant.demandes.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Créer ma première demande

                    </a>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
