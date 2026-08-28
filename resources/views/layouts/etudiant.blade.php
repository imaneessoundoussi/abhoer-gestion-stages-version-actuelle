
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('page-title', 'Espace étudiant') - ABHOER
    </title>

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        /* =========================================================
           VARIABLES
        ========================================================= */

        :root {
            --abhoer-dark: #14213d;
            --abhoer-dark-2: #1b2d50;
            --abhoer-blue: #2563eb;
            --abhoer-blue-dark: #1d4ed8;
            --abhoer-blue-light: #eff6ff;

            --abhoer-bg: #f5f7fb;
            --abhoer-white: #ffffff;

            --abhoer-text: #172033;
            --abhoer-muted: #7b8495;

            --abhoer-border: #e7ebf2;

            --sidebar-width: 270px;
            --topbar-height: 82px;
        }


        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--abhoer-bg);
            color: var(--abhoer-text);

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }

        a {
            text-decoration: none;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;

            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            z-index: 1000;

            color: #ffffff;

            background:
                linear-gradient(
                    180deg,
                    #14213d 0%,
                    #101a30 100%
                );

            box-shadow:
                8px 0 30px rgba(20, 33, 61, 0.08);

            overflow-y: auto;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {
            height: 90px;

            display: flex;
            align-items: center;

            padding: 0 24px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
        }

        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-logo {
            width: 43px;
            height: 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(255, 255, 255, 0.10);

            border:
                1px solid rgba(255, 255, 255, 0.12);

            font-size: 20px;
        }

        .brand-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .3px;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 11px;
            color: rgba(255, 255, 255, .60);
            margin-top: 3px;
        }


        /* =========================================================
           NAVIGATION
        ========================================================= */

        .nav-section {
            padding: 25px 15px;
        }

        .nav-title {
            font-size: 10px;
            font-weight: 700;

            letter-spacing: 1.2px;

            color:
                rgba(255, 255, 255, .40);

            padding:
                0 12px 12px;
        }

        .nav-link {
            position: relative;

            display: flex;
            align-items: center;

            gap: 13px;

            padding: 12px 13px;

            margin-bottom: 6px;

            border-radius: 11px;

            color:
                rgba(255, 255, 255, .68);

            font-size: 14px;
            font-weight: 500;

            transition:
                all .2s ease;
        }

        .nav-link:hover {
            color: #ffffff;

            background:
                rgba(255, 255, 255, .08);

            transform:
                translateX(2px);
        }

        .nav-link.active {
            color: #ffffff;

            background:
                linear-gradient(
                    90deg,
                    rgba(37, 99, 235, .95),
                    rgba(37, 99, 235, .75)
                );

            box-shadow:
                0 7px 20px
                rgba(37, 99, 235, .22);

            font-weight: 600;
        }

        .nav-link.active::before {
            content: "";

            position: absolute;

            left: 0;
            top: 9px;
            bottom: 9px;

            width: 3px;

            border-radius:
                0 5px 5px 0;

            background: #ffffff;
        }

        .nav-icon {
            width: 36px;
            height: 36px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background:
                rgba(255, 255, 255, .06);

            font-size: 17px;

            transition:
                all .2s ease;
        }

        .nav-link:hover .nav-icon {
            background:
                rgba(255, 255, 255, .11);
        }

        .nav-link.active .nav-icon {
            background:
                rgba(255, 255, 255, .14);
        }

        .nav-text {
            flex: 1;
        }


        /* =========================================================
           MAIN
        ========================================================= */

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {
            height: var(--topbar-height);

            background: #ffffff;

            border-bottom:
                1px solid var(--abhoer-border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 32px;

            position: sticky;
            top: 0;

            z-index: 900;

            box-shadow:
                0 2px 12px rgba(20, 33, 61, .025);
        }

        .page-heading {
            display: flex;
            align-items: center;

            gap: 12px;
        }

        .page-heading-icon {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                var(--abhoer-blue-light);

            color:
                var(--abhoer-blue);

            border-radius: 10px;

            font-size: 18px;
        }

        .page-heading h5 {
            color: var(--abhoer-text);
            font-size: 17px;
        }

        .page-heading small {
            color: var(--abhoer-muted);
            font-size: 12px;
        }


        /* =========================================================
           USER
        ========================================================= */

        .user-box {
            display: flex;
            align-items: center;

            gap: 11px;
        }

        .user-avatar {
            width: 43px;
            height: 43px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            color: #ffffff;

            font-weight: 700;
            font-size: 15px;

            box-shadow:
                0 5px 15px
                rgba(37, 99, 235, .18);
        }

        .user-info {
            line-height: 1.2;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;

            color:
                var(--abhoer-text);
        }

        .user-role {
            display: block;

            font-size: 11px;

            color:
                var(--abhoer-muted);

            margin-top: 4px;
        }

        .logout-button {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px !important;

            margin-left: 8px;

            transition:
                all .2s ease;
        }

        .logout-button:hover {
            transform:
                translateY(-1px);
        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .content-area {
            padding: 30px 32px 45px;
        }


        /* =========================================================
           CARDS
        ========================================================= */

        .card,
        .dashboard-card {
            background: #ffffff;

            border:
                1px solid var(--abhoer-border);

            border-radius: 15px;

            box-shadow:
                0 5px 20px
                rgba(20, 33, 61, .045);

            transition:
                box-shadow .2s ease,
                transform .2s ease;
        }

        .dashboard-card:hover {
            box-shadow:
                0 8px 25px
                rgba(20, 33, 61, .065);
        }

        .card-header {
            background: #ffffff;

            border-bottom:
                1px solid var(--abhoer-border);
        }


        /* =========================================================
           BUTTONS
        ========================================================= */

        .btn {
            border-radius: 9px;

            font-weight: 600;

            transition:
                all .2s ease;
        }

        .btn-primary {
            background:
                var(--abhoer-blue);

            border-color:
                var(--abhoer-blue);

            box-shadow:
                0 5px 12px
                rgba(37, 99, 235, .15);
        }

        .btn-primary:hover {
            background:
                var(--abhoer-blue-dark);

            border-color:
                var(--abhoer-blue-dark);

            transform:
                translateY(-1px);

            box-shadow:
                0 7px 16px
                rgba(37, 99, 235, .20);
        }


        /* =========================================================
           TABLES
        ========================================================= */

        .table {
            color:
                var(--abhoer-text);
        }

        .table thead th {
            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: .5px;

            color:
                var(--abhoer-muted);

            font-weight: 700;

            padding:
                15px 16px;

            background:
                #f8fafc;

            border-bottom:
                1px solid var(--abhoer-border);
        }

        .table tbody td {
            padding:
                15px 16px;

            border-color:
                var(--abhoer-border);

            font-size: 13px;
        }

        .table-hover tbody tr:hover {
            background:
                #f8faff;
        }


        /* =========================================================
           BADGES
        ========================================================= */

        .badge {
            border-radius: 7px;

            padding:
                6px 9px;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: .2px;
        }


        /* =========================================================
           ALERTS
        ========================================================= */

        .alert {
            border-radius: 11px;

            border: none;

            font-size: 13px;
        }


        /* =========================================================
           FORMS
        ========================================================= */

        .form-control,
        .form-select {
            border-radius: 9px;

            border-color:
                #dfe4ec;

            padding:
                10px 13px;

            font-size: 13px;

            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color:
                var(--abhoer-blue);

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, .08) !important;
        }

        .form-label {
            font-size: 13px;

            font-weight: 600;

            color:
                var(--abhoer-text);
        }


        /* =========================================================
           SCROLLBAR
        ========================================================= */

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background:
                rgba(255, 255, 255, .12);

            border-radius: 10px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991px) {

            :root {
                --sidebar-width: 230px;
            }

            .content-area {
                padding:
                    25px 20px 35px;
            }

            .topbar {
                padding:
                    0 20px;
            }

            .brand {
                padding:
                    0 18px;
            }

            .nav-section {
                padding:
                    20px 10px;
            }
        }


        @media (max-width: 767px) {

            :root {
                --sidebar-width: 72px;
            }

            .sidebar {
                width: 72px;
            }

            .brand {
                height: 75px;

                justify-content: center;

                padding: 0;
            }

            .brand-wrapper {
                justify-content: center;
            }

            .brand-title,
            .brand-subtitle,
            .nav-title,
            .nav-text {
                display: none;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
            }

            .nav-section {
                padding:
                    15px 9px;
            }

            .nav-link {
                justify-content: center;

                padding:
                    8px;

                gap: 0;
            }

            .nav-link.active::before {
                display: none;
            }

            .nav-icon {
                width: 42px;
                height: 42px;
            }

            .main-content {
                margin-left: 72px;
            }

            .topbar {
                height: 75px;
            }

            .page-heading small {
                display: none;
            }

            .page-heading-icon {
                width: 38px;
                height: 38px;
            }

            .user-info {
                display: none;
            }

            .logout-button {
                margin-left: 4px;
            }

            .content-area {
                padding:
                    20px 15px 30px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside class="sidebar">

        {{-- BRAND --}}
        <div class="brand">

            <div class="brand-wrapper">

                <div class="brand-logo">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <div>

                    <div class="brand-title">
                        ABHOER
                    </div>

                    <div class="brand-subtitle">
                        Gestion des stages
                    </div>

                </div>

            </div>

        </div>


        {{-- NAVIGATION --}}
        <div class="nav-section">

            <div class="nav-title">
                ESPACE ÉTUDIANT
            </div>


            {{-- TABLEAU DE BORD --}}
            <a
                href="{{ route('etudiant.dashboard') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.dashboard') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>

                <span class="nav-text">
                    Tableau de bord
                </span>

            </a>


            {{-- MES DEMANDES --}}
            <a
                href="{{ route('etudiant.demandes.index') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.demandes.*') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>

                <span class="nav-text">
                    Mes demandes
                </span>

            </a>


            {{-- NOUVELLE DEMANDE --}}
            <a
                href="{{ route('etudiant.demandes.create') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.demandes.create') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-plus-lg"></i>
                </div>

                <span class="nav-text">
                    Nouvelle demande
                </span>

            </a>


            {{-- DOCUMENTS --}}
            <a
                href="{{ route('etudiant.documents.index') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.documents.*') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>

                <span class="nav-text">
                    Mes documents
                </span>

            </a>


            {{-- NOTIFICATIONS --}}
            <a
                href="{{ route('etudiant.notifications') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.notifications*') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-bell-fill"></i>
                </div>

                <span class="nav-text">
                    Notifications
                </span>

            </a>


            {{-- PROFIL --}}
            <a
                href="{{ route('etudiant.profil') }}"
                class="nav-link
                    {{ request()->routeIs('etudiant.profil*') ? 'active' : '' }}"
            >

                <div class="nav-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <span class="nav-text">
                    Mon profil
                </span>

            </a>

        </div>

    </aside>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <div class="main-content">


        {{-- =====================================================
             TOPBAR
        ====================================================== --}}

        <header class="topbar">

            {{-- PAGE TITLE --}}
            <div class="page-heading">

                <div class="page-heading-icon">

                    @if(request()->routeIs('etudiant.dashboard'))

                        <i class="bi bi-grid-1x2-fill"></i>

                    @elseif(request()->routeIs('etudiant.demandes.*'))

                        <i class="bi bi-file-earmark-text-fill"></i>

                    @elseif(request()->routeIs('etudiant.documents.*'))

                        <i class="bi bi-folder2-open"></i>

                    @elseif(request()->routeIs('etudiant.notifications*'))

                        <i class="bi bi-bell-fill"></i>

                    @elseif(request()->routeIs('etudiant.profil*'))

                        <i class="bi bi-person-fill"></i>

                    @else

                        <i class="bi bi-grid-1x2-fill"></i>

                    @endif

                </div>


                <div>

                    <h5 class="mb-0 fw-bold">
                        @yield('page-title', 'Espace étudiant')
                    </h5>

                    <small>
                        Plateforme de gestion des stages
                    </small>

                </div>

            </div>


            {{-- USER --}}
            <div class="user-box">


                {{-- AVATAR --}}
                <div class="user-avatar">

                    @if(auth()->check())

                        {{ strtoupper(
                            substr(
                                auth()->user()->prenom ?? 'E',
                                0,
                                1
                            )
                        ) }}

                    @else

                        E

                    @endif

                </div>


                {{-- INFORMATIONS --}}
                <div class="user-info">

                    @if(auth()->check())

                        <div class="user-name">

                            {{ auth()->user()->prenom ?? '' }}
                            {{ auth()->user()->nom ?? '' }}

                        </div>

                        <span class="user-role">
                            Étudiant
                        </span>

                    @endif

                </div>


                {{-- LOGOUT --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="m-0"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-danger logout-button"
                        title="Déconnexion"
                    >

                        <i class="bi bi-box-arrow-right"></i>

                    </button>

                </form>

            </div>

        </header>


        {{-- =====================================================
             PAGE CONTENT
        ====================================================== --}}

        <main class="content-area">

            @yield('content')

        </main>

    </div>


    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')

</body>

</html>