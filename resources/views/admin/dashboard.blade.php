@extends('layouts.admin')

@section('title', 'Tableau de bord administrateur')

@section('page-title', 'Tableau de bord administrateur')

@section('page-description')
    Bienvenue dans votre espace d'administration de l'ABHOER.
@endsection


@section('content')

<div class="container-fluid px-0">


    {{-- =====================================================
         STATISTIQUES PRINCIPALES
    ====================================================== --}}

    <div class="row g-4 mb-4">


        {{-- TOTAL DEMANDES --}}

        <div class="col-xl-3 col-md-6">

            <div class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Total demandes
                        </div>

                        <div class="admin-stat-number">
                            {{ $totalDemandes }}
                        </div>

                        <div class="admin-stat-description">
                            Demandes enregistrées
                        </div>

                    </div>


                    <div class="admin-stat-icon icon-primary">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- EN ATTENTE --}}

        <div class="col-xl-3 col-md-6">

            <div class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            En attente
                        </div>

                        <div class="admin-stat-number text-warning">
                            {{ $demandesEnAttente }}
                        </div>

                        <div class="admin-stat-description">
                            À traiter
                        </div>

                    </div>


                    <div class="admin-stat-icon icon-warning">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- ACCEPTEES --}}

        <div class="col-xl-3 col-md-6">

            <div class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Acceptées
                        </div>

                        <div class="admin-stat-number text-success">
                            {{ $demandesAcceptees }}
                        </div>

                        <div class="admin-stat-description">
                            Demandes acceptées
                        </div>

                    </div>


                    <div class="admin-stat-icon icon-success">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- REFUSEES --}}

        <div class="col-xl-3 col-md-6">

            <div class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Refusées
                        </div>

                        <div class="admin-stat-number text-danger">
                            {{ $demandesRefusees }}
                        </div>

                        <div class="admin-stat-description">
                            Demandes refusées
                        </div>

                    </div>


                    <div class="admin-stat-icon icon-danger">

                        <i class="bi bi-x-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMATIONS SYSTEME
    ====================================================== --}}

    <div class="row g-4">


        {{-- UTILISATEURS --}}

        <div class="col-xl-4 col-md-6">

            <div class="admin-info-card">

                <div class="admin-info-header">


                    <div class="admin-info-icon">

                        <i class="bi bi-people"></i>

                    </div>


                    <div>

                        <h5 class="admin-info-title">
                            Utilisateurs
                        </h5>

                        <p class="admin-info-text">
                            Comptes enregistrés sur la plateforme
                        </p>

                    </div>

                </div>


                <div class="admin-info-value">

                    {{ $totalUtilisateurs }}

                </div>


                <div class="admin-info-footer">

                    <span>
                        Utilisateur(s)
                    </span>


                    <a
                        href="{{ route('admin.utilisateurs.index') }}"
                        class="admin-link"
                    >

                        Gérer

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>


        {{-- CANDIDATS --}}

        <div class="col-xl-4 col-md-6">

            <div class="admin-info-card">

                <div class="admin-info-header">


                    <div class="admin-info-icon">

                        <i class="bi bi-person-badge"></i>

                    </div>


                    <div>

                        <h5 class="admin-info-title">
                            Candidats
                        </h5>

                        <p class="admin-info-text">
                            Étudiants inscrits dans la plateforme
                        </p>

                    </div>

                </div>


                <div class="admin-info-value">

                    {{ $totalCandidats }}

                </div>


                <div class="admin-info-footer">

                    <span>
                        Candidat(s)
                    </span>


                    <span class="text-success">

                        <i class="bi bi-check-circle me-1"></i>

                        Actifs

                    </span>

                </div>

            </div>

        </div>


        {{-- SERVICES --}}

        <div class="col-xl-4 col-md-6">

            <div class="admin-info-card">

                <div class="admin-info-header">


                    <div class="admin-info-icon">

                        <i class="bi bi-diagram-3"></i>

                    </div>


                    <div>

                        <h5 class="admin-info-title">
                            Services
                        </h5>

                        <p class="admin-info-text">
                            Services disponibles pour les stages
                        </p>

                    </div>

                </div>


                <div class="admin-info-value">

                    {{ $totalServices }}

                </div>


                <div class="admin-info-footer">

                    <span>
                        Service(s)
                    </span>


                    <span class="text-primary">

                        <i class="bi bi-building me-1"></i>

                        ABHOER

                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ACTIONS RAPIDES
    ====================================================== --}}

    <div class="admin-section-card mt-4">


        <div class="admin-section-header">

            <div>

                <h5 class="admin-section-title">
                    Actions rapides
                </h5>

                <p class="admin-section-description">
                    Accédez rapidement aux principales fonctions
                    d'administration.
                </p>

            </div>

        </div>


        <div class="row g-3">


            {{-- GERER UTILISATEURS --}}

            <div class="col-xl-4 col-md-6">

                <a
                    href="{{ route('admin.utilisateurs.index') }}"
                    class="admin-action"
                >

                    <div class="admin-action-icon">

                        <i class="bi bi-people"></i>

                    </div>


                    <div>

                        <div class="admin-action-title">
                            Gérer les utilisateurs
                        </div>

                        <div class="admin-action-text">
                            Consulter et gérer les comptes
                        </div>

                    </div>


                    <i class="bi bi-chevron-right ms-auto"></i>

                </a>

            </div>


            {{-- AJOUTER UTILISATEUR --}}

            <div class="col-xl-4 col-md-6">

                <a
                    href="{{ route('admin.utilisateurs.create') }}"
                    class="admin-action"
                >

                    <div class="admin-action-icon">

                        <i class="bi bi-person-plus"></i>

                    </div>


                    <div>

                        <div class="admin-action-title">
                            Ajouter un utilisateur
                        </div>

                        <div class="admin-action-text">
                            Créer un nouveau compte
                        </div>

                    </div>


                    <i class="bi bi-chevron-right ms-auto"></i>

                </a>

            </div>


            {{-- VOIR LES DEMANDES --}}

            <div class="col-xl-4 col-md-6">

                <a
                    href="{{ route('admin.demandes.index') }}"
                    class="admin-action"
                >

                    <div class="admin-action-icon">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>


                    <div>

                        <div class="admin-action-title">
                            Voir les demandes
                        </div>

                        <div class="admin-action-text">
                            Consulter les demandes de stage
                        </div>

                    </div>


                    <i class="bi bi-chevron-right ms-auto"></i>

                </a>

            </div>

        </div>

    </div>

</div>


<style>


    /* =====================================================
       STATISTIQUES
    ====================================================== */

    .admin-stat-card {

        background: #ffffff;

        border: 1px solid #e8edf3;

        border-radius: 16px;

        min-height: 155px;

        padding: 24px;

        box-shadow:
            0 5px 20px rgba(23, 32, 51, .045);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }


    .admin-stat-card:hover {

        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(23, 32, 51, .08);
    }


    .admin-stat-content {

        display: flex;

        justify-content: space-between;

        align-items: flex-start;

        height: 100%;
    }


    .admin-stat-label {

        color: #697386;

        font-size: 13px;

        font-weight: 600;

        margin-bottom: 8px;
    }


    .admin-stat-number {

        color: #176f78;

        font-size: 34px;

        line-height: 1;

        font-weight: 800;
    }


    .admin-stat-description {

        color: #9aa3b2;

        font-size: 12px;

        margin-top: 9px;
    }


    .admin-stat-icon {

        width: 52px;
        height: 52px;

        border-radius: 14px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 22px;
    }


    .icon-primary {

        color: #176f78;

        background: #e7f6f7;
    }


    .icon-warning {

        color: #d97706;

        background: #fff5df;
    }


    .icon-success {

        color: #16a34a;

        background: #eaf8ef;
    }


    .icon-danger {

        color: #dc2626;

        background: #fff0f1;
    }


    /* =====================================================
       INFO CARDS
    ====================================================== */

    .admin-info-card {

        background: #ffffff;

        border: 1px solid #e8edf3;

        border-radius: 16px;

        padding: 24px;

        box-shadow:
            0 5px 20px rgba(23, 32, 51, .045);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }


    .admin-info-card:hover {

        transform: translateY(-2px);

        box-shadow:
            0 10px 26px rgba(23, 32, 51, .07);
    }


    .admin-info-header {

        display: flex;

        align-items: center;

        gap: 14px;
    }


    .admin-info-icon {

        width: 46px;
        height: 46px;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #e7f6f7;

        color: #176f78;

        font-size: 20px;
    }


    .admin-info-title {

        margin: 0;

        font-size: 16px;

        font-weight: 750;

        color: #172033;
    }


    .admin-info-text {

        margin: 3px 0 0;

        font-size: 12px;

        color: #8993a4;
    }


    .admin-info-value {

        font-size: 35px;

        font-weight: 800;

        color: #176f78;

        margin-top: 25px;
    }


    .admin-info-footer {

        display: flex;

        justify-content: space-between;

        align-items: center;

        margin-top: 15px;

        padding-top: 14px;

        border-top: 1px solid #eef1f5;

        font-size: 12px;

        color: #8993a4;
    }


    .admin-link {

        text-decoration: none;

        color: #176f78;

        font-weight: 700;
    }


    .admin-link:hover {

        color: #0e535a;
    }


    /* =====================================================
       SECTION
    ====================================================== */

    .admin-section-card {

        background: #ffffff;

        border: 1px solid #e8edf3;

        border-radius: 16px;

        padding: 24px;

        box-shadow:
            0 5px 20px rgba(23, 32, 51, .045);
    }


    .admin-section-header {

        margin-bottom: 20px;
    }


    .admin-section-title {

        margin: 0;

        font-size: 17px;

        font-weight: 750;
    }


    .admin-section-description {

        color: #8993a4;

        font-size: 13px;

        margin: 5px 0 0;
    }


    /* =====================================================
       ACTIONS
    ====================================================== */

    .admin-action {

        display: flex;

        align-items: center;

        gap: 14px;

        width: 100%;

        padding: 16px;

        background: #f8fafc;

        border: 1px solid #edf1f5;

        border-radius: 12px;

        text-decoration: none;

        color: #172033;

        transition:
            background .2s ease,
            border-color .2s ease,
            transform .2s ease;
    }


    .admin-action:hover {

        background: #f0f8f9;

        border-color: #c9e7e8;

        color: #176f78;

        transform: translateX(2px);
    }


    .admin-action-icon {

        width: 42px;
        height: 42px;

        border-radius: 11px;

        background: #e7f6f7;

        color: #176f78;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 18px;

        flex-shrink: 0;
    }


    .admin-action-title {

        font-size: 13px;

        font-weight: 750;
    }


    .admin-action-text {

        font-size: 11px;

        color: #8993a4;

        margin-top: 2px;
    }


    .admin-action > .bi-chevron-right {

        color: #a0a9b7;
    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 768px) {

        .admin-stat-card,
        .admin-info-card,
        .admin-section-card {

            padding: 20px;
        }

    }

</style>

@endsection