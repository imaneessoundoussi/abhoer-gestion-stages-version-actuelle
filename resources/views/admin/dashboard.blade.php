<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>ABHOER - Administration</title>

    <style>
        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* =========================================================
           BODY
        ========================================================= */

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #1e293b;
        }

        /* =========================================================
           LAYOUT
        ========================================================= */

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 20px 14px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-title {
            background: #5146b8;
            color: white;
            font-size: 18px;
            font-weight: 700;
            padding: 11px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 13px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .sidebar-menu a:hover {
            background: #f1f5f9;
            color: #4338ca;
        }

        .sidebar-menu a.active {
            background: #f3f4fb;
            color: #4338ca;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .logout-link {
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .logout-link button {
            width: 100%;
            border: none;
            background: transparent;
            color: #dc2626;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 13px;
            cursor: pointer;
            border-radius: 8px;
        }

        .logout-link button:hover {
            background: #fef2f2;
        }

        /* =========================================================
           MAIN
        ========================================================= */

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 7px;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
        }

        .admin-badge {
            background: #eef2ff;
            color: #4338ca;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        /* =========================================================
           STATISTIQUES
        ========================================================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .icon-blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .icon-orange {
            background: #fff7ed;
            color: #f59e0b;
        }

        .icon-green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .icon-red {
            background: #fef2f2;
            color: #dc2626;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .blue-number {
            color: #2563eb;
        }

        .orange-number {
            color: #f59e0b;
        }

        .green-number {
            color: #16a34a;
        }

        .red-number {
            color: #dc2626;
        }

        .stat-description {
            color: #94a3b8;
            font-size: 12px;
        }

        /* =========================================================
           GRAPHIQUES
        ========================================================= */

        .charts-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 18px;
            margin-bottom: 20px;
        }

        .panel {
            background: #ffffff;
            border: 1px solid #e8edf5;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }

        .panel-header {
            padding: 20px;
            border-bottom: 1px solid #eef2f7;
        }

        .panel-header h2 {
            font-size: 15px;
            font-weight: 700;
            color: #334155;
        }

        .panel-body {
            padding: 20px;
        }

        /* =========================================================
           BAR CHART
        ========================================================= */

        .bar-chart {
            height: 250px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            gap: 18px;
            padding: 20px 10px 35px;
            border-bottom: 1px solid #e5e7eb;
        }

        .bar-item {
            height: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            position: relative;
        }

        .bar-value {
            font-size: 12px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 7px;
        }

        .bar {
            width: 42px;
            max-width: 70%;
            background: #2563eb;
            border-radius: 5px 5px 0 0;
            min-height: 4px;
            transition: 0.3s;
        }

        .bar:hover {
            background: #1d4ed8;
        }

        .bar-label {
            position: absolute;
            bottom: -28px;
            font-size: 11px;
            color: #64748b;
            text-align: center;
            white-space: nowrap;
        }

        /* =========================================================
           STATUTS
        ========================================================= */

        .status-layout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            min-height: 250px;
        }

        .donut {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: conic-gradient(
                #2563eb 0deg,
                #2563eb 160deg,
                #f59e0b 160deg,
                #f59e0b 245deg,
                #16a34a 245deg,
                #16a34a 300deg,
                #dc2626 300deg,
                #dc2626 360deg
            );
            position: relative;
            flex-shrink: 0;
        }

        .donut::after {
            content: "";
            position: absolute;
            width: 88px;
            height: 88px;
            background: white;
            border-radius: 50%;
            top: 41px;
            left: 41px;
        }

        .legend {
            list-style: none;
        }

        .legend li {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 14px;
            font-size: 12px;
            color: #475569;
        }

        .legend-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
        }

        .dot-blue {
            background: #2563eb;
        }

        .dot-orange {
            background: #f59e0b;
        }

        .dot-green {
            background: #16a34a;
        }

        .dot-red {
            background: #dc2626;
        }

        .legend strong {
            margin-left: auto;
            padding-left: 20px;
        }

        /* =========================================================
           INFORMATIONS
        ========================================================= */

        .information-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-box {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 12px;
            padding: 20px;
        }

        .info-box h3 {
            font-size: 14px;
            color: #475569;
            margin-bottom: 10px;
        }

        .info-value {
            font-size: 25px;
            font-weight: 700;
            color: #1e293b;
        }

        /* =========================================================
           ACTIVITES
        ========================================================= */

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 34px;
            height: 34px;
            border: 1px solid #dbe4ef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 14px;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .activity-subtitle {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 3px;
        }

        .activity-date {
            font-size: 11px;
            color: #64748b;
            white-space: nowrap;
        }

        /* =========================================================
           DEMANDES
        ========================================================= */

        .table-wrapper {
            overflow-x: auto;
        }

        .requests-table {
            width: 100%;
            border-collapse: collapse;
        }

        .requests-table th {
            text-align: left;
            padding: 13px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
        }

        .requests-table td {
            padding: 14px 13px;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            color: #475569;
        }

        .requests-table tr:hover {
            background: #fafbff;
        }

        /* =========================================================
           BADGES
        ========================================================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-accepted {
            background: #f0fdf4;
            color: #15803d;
        }

        .status-refused {
            background: #fef2f2;
            color: #b91c1c;
        }

        .status-default {
            background: #f1f5f9;
            color: #475569;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty {
            padding: 35px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .information-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 800px) {

            .sidebar {
                width: 210px;
            }

            .main-content {
                margin-left: 210px;
                width: calc(100% - 210px);
                padding: 20px;
            }
        }

        @media (max-width: 650px) {

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .admin-layout {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }

            .stats-grid,
            .information-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                display: block;
            }

            .admin-badge {
                display: inline-block;
                margin-top: 12px;
            }

            .status-layout {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="admin-layout">

    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside class="sidebar">

        <div class="sidebar-title">
            Espace Administrateur
        </div>

        <ul class="sidebar-menu">

            <li>
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="active"
                >
                    <span class="menu-icon">⌂</span>
                    Tableau de bord
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">♙</span>
                    Utilisateurs
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">⚙</span>
                    Services
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">▣</span>
                    Périodes de stage
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">▤</span>
                    Demandes
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">▥</span>
                    Stages
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">⌁</span>
                    Statistiques
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">⚙</span>
                    Paramètres
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">◉</span>
                    Journal des activités
                </a>
            </li>

        </ul>

        <div class="logout-link">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button type="submit">
                    <span class="menu-icon">⇥</span>
                    Déconnexion
                </button>
            </form>

        </div>

    </aside>


    {{-- =========================================================
         CONTENU PRINCIPAL
    ========================================================== --}}

    <main class="main-content">

        {{-- HEADER --}}

        <div class="page-header">

            <div>

                <h1>
                    Tableau de bord
                </h1>

                <p>
                    Bienvenue dans l'espace d'administration de l'ABHOER.
                </p>

            </div>

            <div class="admin-badge">
                Administrateur
            </div>

        </div>


        {{-- =====================================================
             CARTES STATISTIQUES
        ====================================================== --}}

        <div class="stats-grid">

            {{-- UTILISATEURS --}}

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Utilisateurs
                    </span>

                    <div class="stat-icon icon-blue">
                        ♙
                    </div>

                </div>

                <div class="stat-number blue-number">
                    {{ $totalUtilisateurs }}
                </div>

                <div class="stat-description">
                    Comptes enregistrés
                </div>

            </div>


            {{-- DEMANDES --}}

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Demandes totales
                    </span>

                    <div class="stat-icon icon-blue">
                        ▤
                    </div>

                </div>

                <div class="stat-number blue-number">
                    {{ $totalDemandes }}
                </div>

                <div class="stat-description">
                    Demandes de stage
                </div>

            </div>


            {{-- STAGES EN COURS --}}

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Stages en cours
                    </span>

                    <div class="stat-icon icon-orange">
                        ◷
                    </div>

                </div>

                <div class="stat-number orange-number">
                    {{ $stagesEnCours }}
                </div>

                <div class="stat-description">
                    Stages actuellement actifs
                </div>

            </div>


            {{-- STAGES TERMINES --}}

            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Stages terminés
                    </span>

                    <div class="stat-icon icon-green">
                        ✓
                    </div>

                </div>

                <div class="stat-number green-number">
                    {{ $stagesTermines }}
                </div>

                <div class="stat-description">
                    Stages finalisés
                </div>

            </div>

        </div>


        {{-- =====================================================
             GRAPHIQUES
        ====================================================== --}}

        <div class="charts-grid">

            {{-- DEMANDES PAR PERIODE --}}

            <div class="panel">

                <div class="panel-header">

                    <h2>
                        Demandes par période
                    </h2>

                </div>

                <div class="panel-body">

                    <div class="bar-chart">

                        @php
                            $maximumDemandes = collect($demandesParMois)
                                ->max('nombre');

                            if ($maximumDemandes < 1) {
                                $maximumDemandes = 1;
                            }
                        @endphp


                        @foreach($demandesParMois as $periode)

                            @php
                                $hauteur = ($periode['nombre'] / $maximumDemandes) * 180;
                            @endphp

                            <div class="bar-item">

                                <div class="bar-value">
                                    {{ $periode['nombre'] }}
                                </div>

                                <div
                                    class="bar"
                                    data-height="{{ $hauteur }}"
                                ></div>

                                <div class="bar-label">
                                    {{ $periode['mois'] }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- DEMANDES PAR STATUT --}}

            <div class="panel">

                <div class="panel-header">

                    <h2>
                        Demandes par statut
                    </h2>

                </div>

                <div class="panel-body">

                    <div class="status-layout">

                        <div class="donut">
                        </div>

                        <ul class="legend">

                            <li>

                                <span class="legend-dot dot-blue"></span>

                                En attente

                                <strong>
                                    {{ $demandesEnAttente }}
                                </strong>

                            </li>


                            <li>

                                <span class="legend-dot dot-orange"></span>

                                En cours

                                <strong>
                                    {{ $stagesEnCours }}
                                </strong>

                            </li>


                            <li>

                                <span class="legend-dot dot-green"></span>

                                Acceptées

                                <strong>
                                    {{ $demandesAcceptees }}
                                </strong>

                            </li>


                            <li>

                                <span class="legend-dot dot-red"></span>

                                Refusées

                                <strong>
                                    {{ $demandesRefusees }}
                                </strong>

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             INFORMATIONS COMPLEMENTAIRES
        ====================================================== --}}

        <div class="information-grid">

            <div class="info-box">

                <h3>
                    Candidats
                </h3>

                <div class="info-value">
                    {{ $totalCandidats }}
                </div>

            </div>


            <div class="info-box">

                <h3>
                    Services disponibles
                </h3>

                <div class="info-value">
                    {{ $totalServices }}
                </div>

            </div>


            <div class="info-box">

                <h3>
                    Demandes en attente
                </h3>

                <div class="info-value">
                    {{ $demandesEnAttente }}
                </div>

            </div>

        </div>


        {{-- =====================================================
             ACTIVITES RECENTES
        ====================================================== --}}

        <div class="panel">

            <div class="panel-header">

                <h2>
                    Activités récentes
                </h2>

            </div>

            <div class="panel-body">

                @if($activitesRecentes->count() > 0)

                    <ul class="activity-list">

                        @foreach($activitesRecentes as $activite)

                            @php

                                $nomCandidat = '-';

                                if ($activite->candidat) {

                                    $nomCandidat = trim(
                                        ($activite->candidat->prenom ?? '') .
                                        ' ' .
                                        ($activite->candidat->nom ?? '')
                                    );

                                }

                                $statutNormalise = strtoupper(
                                    str_replace(
                                        ' ',
                                        '_',
                                        $activite->statut ?? ''
                                    )
                                );

                            @endphp


                            <li class="activity-item">

                                <div class="activity-icon">
                                    ⓘ
                                </div>


                                <div class="activity-content">

                                    @if(
                                        $statutNormalise === 'ACCEPTEE' ||
                                        $statutNormalise === 'ACCEPTE'
                                    )

                                        <div class="activity-title">

                                            Demande acceptée pour
                                            {{ $nomCandidat }}

                                        </div>

                                    @elseif(
                                        $statutNormalise === 'REFUSEE' ||
                                        $statutNormalise === 'REFUSE'
                                    )

                                        <div class="activity-title">

                                            Demande refusée pour
                                            {{ $nomCandidat }}

                                        </div>

                                    @else

                                        <div class="activity-title">

                                            Nouvelle demande soumise par
                                            {{ $nomCandidat }}

                                        </div>

                                    @endif


                                    <div class="activity-subtitle">

                                        @if($activite->service)

                                            {{ $activite->service->nomService }}

                                        @else

                                            Demande de stage

                                        @endif

                                    </div>

                                </div>


                                <div class="activity-date">

                                    @if($activite->dateDepot)

                                        {{ $activite->dateDepot->format('d/m/Y H:i') }}

                                    @else

                                        -

                                    @endif

                                </div>

                            </li>

                        @endforeach

                    </ul>

                @else

                    <div class="empty">
                        Aucune activité récente.
                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             DERNIERES DEMANDES
        ====================================================== --}}

        <div
            class="panel"
            style="margin-top: 20px;"
        >

            <div class="panel-header">

                <h2>
                    Dernières demandes
                </h2>

            </div>


            <div class="panel-body">

                @if($dernieresDemandes->count() > 0)

                    <div class="table-wrapper">

                        <table class="requests-table">

                            <thead>

                                <tr>

                                    <th>
                                        Candidat
                                    </th>

                                    <th>
                                        Service
                                    </th>

                                    <th>
                                        Type de stage
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                    <th>
                                        Date de dépôt
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($dernieresDemandes as $demande)

                                    @php

                                        $nomCandidat = '-';

                                        if ($demande->candidat) {

                                            $nomCandidat = trim(
                                                ($demande->candidat->prenom ?? '') .
                                                ' ' .
                                                ($demande->candidat->nom ?? '')
                                            );

                                        }

                                        $statut = strtoupper(
                                            str_replace(
                                                ' ',
                                                '_',
                                                $demande->statut ?? ''
                                            )
                                        );

                                    @endphp


                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $nomCandidat }}
                                            </strong>

                                        </td>


                                        <td>

                                            @if($demande->service)

                                                {{ $demande->service->nomService }}

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <td>
                                            {{ $demande->typeDepot ?? '-' }}
                                        </td>


                                        <td>

                                            @if($statut === 'EN_ATTENTE')

                                                <span class="status-badge status-pending">
                                                    En attente
                                                </span>

                                            @elseif(
                                                $statut === 'ACCEPTEE' ||
                                                $statut === 'ACCEPTE'
                                            )

                                                <span class="status-badge status-accepted">
                                                    Acceptée
                                                </span>

                                            @elseif(
                                                $statut === 'REFUSEE' ||
                                                $statut === 'REFUSE'
                                            )

                                                <span class="status-badge status-refused">
                                                    Refusée
                                                </span>

                                            @else

                                                <span class="status-badge status-default">
                                                    {{ $demande->statut ?? '-' }}
                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            @if($demande->dateDepot)

                                                {{ $demande->dateDepot->format('d/m/Y') }}

                                            @else

                                                -

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">
                        Aucune demande de stage pour le moment.
                    </div>

                @endif

            </div>

        </div>

    </main>

</div>


<script>
    /*
     * =========================================================
     * BARRES DU GRAPHIQUE
     * =========================================================
     *
     * La hauteur de chaque barre est stockée
     * dans l'attribut data-height.
     */

    document
        .querySelectorAll('.bar')
        .forEach(function (bar) {

            const height = parseFloat(
                bar.dataset.height
            );

            if (!isNaN(height)) {

                bar.style.height =
                    Math.max(height, 4) + 'px';

            }

        });
</script>

</body>
</html>