<!DOCTYPE html>

<html lang="fr">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    @yield('title', 'Administration - ABHOER')
</title>

{{-- Bootstrap 5 --}}
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

{{-- Bootstrap Icons --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

<style>

    /* =========================================================
       VARIABLES — THÈME BLEU NUIT PROFESSIONNEL
    ========================================================= */

    :root {

        /* Bleu nuit principal */
        --admin-primary: #14213d;
        --admin-primary-dark: #0d172b;
        --admin-primary-light: #1f355d;

        /* Bleu royal */
        --admin-blue: #2563eb;
        --admin-blue-dark: #1d4ed8;
        --admin-blue-light: #eff6ff;
        --admin-blue-soft: #eaf2ff;

        /* Arrière-plans */
        --admin-bg: #f5f7fb;
        --admin-white: #ffffff;
        --admin-sidebar: #14213d;

        /* Texte */
        --admin-text: #172033;
        --admin-muted: #7b8496;
        --admin-muted-light: #9aa3b3;

        /* Bordures */
        --admin-border: #e5e9f0;

        /* États */
        --admin-success: #16a34a;
        --admin-success-soft: #ecfdf3;

        --admin-warning: #d97706;
        --admin-warning-soft: #fff7ed;

        --admin-danger: #dc2626;
        --admin-danger-soft: #fff1f2;

        /* Dimensions */
        --sidebar-width: 260px;

    }


    /* =========================================================
       RESET
    ========================================================= */

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        min-height: 100%;
    }

    body {

        font-family:
            Inter,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            Roboto,
            Arial,
            sans-serif;

        background: var(--admin-bg);

        color: var(--admin-text);

        -webkit-font-smoothing: antialiased;

    }

    a {
        text-decoration: none;
    }


    /* =========================================================
       GLOBAL LAYOUT
    ========================================================= */

    .admin-layout {

        min-height: 100vh;

        display: flex;

    }


    /* =========================================================
       SIDEBAR
    ========================================================= */

    .admin-sidebar {

        width: var(--sidebar-width);

        min-width: var(--sidebar-width);

        height: 100vh;

        position: fixed;

        top: 0;
        left: 0;

        background:
            linear-gradient(
                180deg,
                #14213d 0%,
                #101a30 100%
            );

        color: #ffffff;

        display: flex;

        flex-direction: column;

        z-index: 1000;

        box-shadow:
            8px 0 30px
            rgba(15, 23, 42, .10);

        overflow-y: auto;

    }


    /* =========================================================
       SIDEBAR BRAND
    ========================================================= */

    .admin-sidebar-brand {

        height: 90px;

        display: flex;

        align-items: center;

        padding: 18px 21px;

        border-bottom:
            1px solid
            rgba(255,255,255,.08);

    }

    .admin-sidebar-logo {

        width: 48px;
        height: 48px;

        object-fit: contain;

        background: #ffffff;

        border-radius: 12px;

        padding: 4px;

        margin-right: 12px;

        box-shadow:
            0 5px 15px
            rgba(0,0,0,.12);

    }

    .admin-sidebar-brand-text {
        min-width: 0;
    }

    .admin-sidebar-brand-title {

        margin: 0;

        font-size: 19px;

        font-weight: 800;

        color: #ffffff;

        letter-spacing: .4px;

        line-height: 1.2;

    }

    .admin-sidebar-brand-subtitle {

        display: block;

        margin-top: 4px;

        font-size: 10px;

        color:
            rgba(255,255,255,.55);

        font-weight: 500;

        letter-spacing: .3px;

    }


    /* =========================================================
       ADMIN PROFILE
    ========================================================= */

    .admin-sidebar-profile {

        margin: 18px 15px 14px;

        padding: 13px;

        background:
            rgba(255,255,255,.055);

        border:
            1px solid
            rgba(255,255,255,.08);

        border-radius: 13px;

        display: flex;

        align-items: center;

        gap: 11px;

    }

    .admin-profile-icon {

        width: 40px;
        height: 40px;

        flex-shrink: 0;

        border-radius: 11px;

        background:
            rgba(37,99,235,.20);

        color: #60a5fa;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 18px;

    }

    .admin-profile-info {
        min-width: 0;
    }

    .admin-profile-name {

        display: block;

        font-size: 13px;

        font-weight: 700;

        color: #ffffff;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

    }

    .admin-profile-role {

        display: block;

        margin-top: 3px;

        font-size: 10px;

        color:
            rgba(255,255,255,.50);

    }


    /* =========================================================
       SIDEBAR MENU
    ========================================================= */

    .admin-sidebar-menu {

        flex: 1;

        padding: 9px 12px;

        overflow-y: auto;

    }

    .admin-menu-title {

        padding: 10px 11px;

        margin-bottom: 6px;

        font-size: 10px;

        font-weight: 800;

        color:
            rgba(255,255,255,.38);

        text-transform: uppercase;

        letter-spacing: 1px;

    }

    .admin-menu-item {
        margin-bottom: 4px;
    }


    /* =========================================================
       MENU LINK
    ========================================================= */

    .admin-menu-link {

        position: relative;

        display: flex;

        align-items: center;

        width: 100%;

        min-height: 45px;

        padding: 10px 13px;

        border-radius: 10px;

        color:
            rgba(255,255,255,.67);

        font-size: 13px;

        font-weight: 500;

        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;

    }

    .admin-menu-link i {

        width: 23px;

        margin-right: 11px;

        font-size: 16px;

        text-align: center;

        flex-shrink: 0;

    }


    /* HOVER */

    .admin-menu-link:hover {

        color: #ffffff;

        background:
            rgba(255,255,255,.075);

        transform:
            translateX(2px);

    }


    /* ACTIVE */

    .admin-menu-link.active {

        color: #ffffff;

        background:
            linear-gradient(
                90deg,
                #2563eb,
                #1d4ed8
            );

        font-weight: 700;

        box-shadow:
            0 7px 18px
            rgba(37,99,235,.25);

    }

    .admin-menu-link.active::before {

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

    .admin-menu-link.active i {
        color: #ffffff;
    }


    /* =========================================================
       SIDEBAR FOOTER
    ========================================================= */

    .admin-sidebar-footer {

        padding: 13px;

        border-top:
            1px solid
            rgba(255,255,255,.08);

    }

    .admin-logout-link {

        width: 100%;

        border: none;

        background: transparent;

        display: flex;

        align-items: center;

        padding: 11px 13px;

        border-radius: 10px;

        color:
            #fda4af;

        font-size: 13px;

        font-weight: 600;

        transition: .2s ease;

    }

    .admin-logout-link:hover {

        background:
            rgba(220,38,38,.12);

        color: #fecdd3;

    }

    .admin-logout-link i {

        width: 23px;

        margin-right: 10px;

        font-size: 16px;

    }


    /* =========================================================
       MAIN AREA
    ========================================================= */

    .admin-main {

        margin-left: var(--sidebar-width);

        width:
            calc(100% - var(--sidebar-width));

        min-height: 100vh;

        display: flex;

        flex-direction: column;

    }


    /* =========================================================
       TOPBAR
    ========================================================= */

    .admin-topbar {

        min-height: 76px;

        background:
            rgba(255,255,255,.97);

        border-bottom:
            1px solid
            var(--admin-border);

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 0 30px;

        position: sticky;

        top: 0;

        z-index: 900;

        box-shadow:
            0 3px 15px
            rgba(20,33,61,.035);

    }

    .admin-topbar-left {

        display: flex;

        align-items: center;

        gap: 12px;

    }

    .admin-topbar-icon {

        width: 41px;
        height: 41px;

        border-radius: 11px;

        background:
            var(--admin-blue-light);

        color:
            var(--admin-blue);

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 18px;

    }

    .admin-topbar-title {

        margin: 0;

        font-size: 16px;

        font-weight: 750;

        color:
            var(--admin-text);

    }

    .admin-topbar-subtitle {

        display: block;

        margin-top: 3px;

        font-size: 11px;

        color:
            var(--admin-muted);

    }


    /* =========================================================
       TOPBAR USER
    ========================================================= */

    .admin-topbar-user {

        display: flex;

        align-items: center;

        gap: 11px;

    }

    .admin-topbar-user-info {
        text-align: right;
    }

    .admin-topbar-user-name {

        font-size: 12px;

        font-weight: 700;

        color:
            var(--admin-text);

    }

    .admin-topbar-user-role {

        display: block;

        font-size: 10px;

        color:
            var(--admin-muted);

        margin-top: 3px;

    }

    .admin-topbar-user-icon {

        width: 40px;
        height: 40px;

        border-radius: 12px;

        background:
            linear-gradient(
                135deg,
                #14213d,
                #2563eb
            );

        color: #ffffff;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 17px;

        box-shadow:
            0 5px 14px
            rgba(37,99,235,.18);

    }


    /* =========================================================
       PAGE
    ========================================================= */

    .admin-page {

        width: 100%;

        max-width: 1500px;

        margin: 0 auto;

        padding: 31px;

    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .admin-page-header {

        margin-bottom: 27px;

    }

    .admin-page-title {

        margin: 0 0 6px;

        font-size: 27px;

        font-weight: 800;

        color:
            var(--admin-text);

        letter-spacing: -.3px;

    }

    .admin-page-description {

        margin: 0;

        font-size: 13px;

        color:
            var(--admin-muted);

    }


    /* =========================================================
       CONTENT
    ========================================================= */

    .admin-content {
        width: 100%;
    }


    /* =========================================================
       CARDS
    ========================================================= */

    .card {

        background:
            #ffffff;

        border:
            1px solid
            var(--admin-border);

        border-radius: 15px;

        box-shadow:
            0 5px 20px
            rgba(20,33,61,.045);

    }

    .card-header {

        background:
            #ffffff;

        border-bottom:
            1px solid
            var(--admin-border);

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
            var(--admin-blue);

        border-color:
            var(--admin-blue);

        box-shadow:
            0 5px 12px
            rgba(37,99,235,.15);

    }

    .btn-primary:hover {

        background:
            var(--admin-blue-dark);

        border-color:
            var(--admin-blue-dark);

        transform:
            translateY(-1px);

        box-shadow:
            0 7px 16px
            rgba(37,99,235,.22);

    }


    /* =========================================================
       OUTLINE PRIMARY
    ========================================================= */

    .btn-outline-primary {

        color:
            var(--admin-blue);

        border-color:
            #bfdbfe;

    }

    .btn-outline-primary:hover {

        background:
            var(--admin-blue);

        border-color:
            var(--admin-blue);

        color: #ffffff;

    }


    /* =========================================================
       TABLES
    ========================================================= */

    .table {

        color:
            var(--admin-text);

        margin-bottom: 0;

    }

    .table thead th {

        font-size: 11px;

        text-transform: uppercase;

        letter-spacing: .55px;

        color:
            var(--admin-muted);

        font-weight: 750;

        padding:
            15px 16px;

        background:
            #f8fafc;

        border-bottom:
            1px solid
            var(--admin-border);

    }

    .table tbody td {

        padding:
            15px 16px;

        border-color:
            var(--admin-border);

        font-size: 13px;

        vertical-align: middle;

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

    .admin-alert {

        border: none;

        border-radius: 11px;

        padding:
            13px 16px;

        font-size: 13px;

        box-shadow:
            0 3px 12px
            rgba(23,32,51,.04);

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
            var(--admin-blue);

        box-shadow:
            0 0 0 3px
            rgba(37,99,235,.09) !important;

    }

    .form-label {

        font-size: 13px;

        font-weight: 600;

        color:
            var(--admin-text);

    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .admin-footer {

        margin-top: auto;

        text-align: center;

        color:
            #98a1b2;

        font-size: 11px;

        padding:
            20px 15px 25px;

    }


    /* =========================================================
       MOBILE BUTTON
    ========================================================= */

    .admin-mobile-button {

        display: none;

        border: none;

        background: transparent;

        color:
            var(--admin-primary);

        font-size: 22px;

    }


    /* =========================================================
       SCROLLBAR
    ========================================================= */

    .admin-sidebar::-webkit-scrollbar {

        width: 5px;

    }

    .admin-sidebar::-webkit-scrollbar-track {

        background: transparent;

    }

    .admin-sidebar::-webkit-scrollbar-thumb {

        background:
            rgba(255,255,255,.12);

        border-radius: 10px;

    }


    /* =========================================================
       RESPONSIVE — TABLET
    ========================================================= */

    @media (max-width: 992px) {

        :root {
            --sidebar-width: 230px;
        }

        .admin-page {

            padding:
                25px 22px;

        }

        .admin-topbar {

            padding:
                0 22px;

        }

    }


    /* =========================================================
       RESPONSIVE — MOBILE
    ========================================================= */

    @media (max-width: 768px) {

        .admin-sidebar {

            transform:
                translateX(-100%);

            transition:
                transform .25s ease;

        }

        .admin-sidebar.show {

            transform:
                translateX(0);

        }

        .admin-main {

            margin-left: 0;

            width: 100%;

        }

        .admin-mobile-button {

            display: block;

        }

        .admin-topbar {

            padding:
                0 15px;

        }

        .admin-topbar-user-info {

            display: none;

        }

        .admin-page {

            padding:
                21px 15px;

        }

        .admin-page-title {

            font-size: 23px;

        }

    }

</style>

@stack('styles')
```

</head>

<body>

<div class="admin-layout">

```
{{-- =========================================================
     SIDEBAR ADMINISTRATEUR
========================================================== --}}

<aside
    class="admin-sidebar"
    id="adminSidebar"
>


    {{-- LOGO --}}

    <div class="admin-sidebar-brand">

        <img
            src="{{ asset('images/logo-abhoer.png') }}"
            alt="Logo ABHOER"
            class="admin-sidebar-logo"
        >

        <div class="admin-sidebar-brand-text">

            <h1 class="admin-sidebar-brand-title">
                ABHOER
            </h1>

            <span class="admin-sidebar-brand-subtitle">
                Gestion des stages
            </span>

        </div>

    </div>


    {{-- PROFIL ADMIN --}}

    <div class="admin-sidebar-profile">

        <div class="admin-profile-icon">

            <i class="bi bi-person-fill"></i>

        </div>

        <div class="admin-profile-info">

            <span class="admin-profile-name">

                @auth

                    {{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Administrateur' }}

                @else

                    Administrateur

                @endauth

            </span>

            <span class="admin-profile-role">
                Administrateur
            </span>

        </div>

    </div>


    {{-- MENU --}}

    <nav class="admin-sidebar-menu">

        <div class="admin-menu-title">
            Administration
        </div>


        {{-- TABLEAU DE BORD --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.dashboard') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >

                <i class="bi bi-grid-1x2-fill"></i>

                <span>
                    Tableau de bord
                </span>

            </a>

        </div>


        {{-- UTILISATEURS --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.utilisateurs.index') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.utilisateurs.*') ? 'active' : '' }}"
            >

                <i class="bi bi-people-fill"></i>

                <span>
                    Utilisateurs
                </span>

            </a>

        </div>


        {{-- DEPARTEMENTS --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.departements.index') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.departements.*') ? 'active' : '' }}"
            >

                <i class="bi bi-diagram-3-fill"></i>

                <span>
                    Départements
                </span>

            </a>

        </div>


        {{-- SERVICES --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.services.index') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
            >

                <i class="bi bi-building-fill"></i>

                <span>
                    Services
                </span>

            </a>

        </div>


        {{-- DEMANDES DE STAGE --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.demandes.index') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}"
            >

                <i class="bi bi-file-earmark-text-fill"></i>

                <span>
                    Demandes de stage
                </span>

            </a>

        </div>


        {{-- =================================================
             SUIVI
        ================================================== --}}

        <div class="admin-menu-title mt-3">
            Suivi
        </div>


        {{-- STAGES --}}

        <div class="admin-menu-item">

            <a
                href="{{ route('admin.stages.index') }}"
                class="admin-menu-link
                    {{ request()->routeIs('admin.stages.*') ? 'active' : '' }}"
            >

                <i class="bi bi-mortarboard-fill"></i>

                <span>
                    Stages
                </span>

            </a>

        </div>

    </nav>


    {{-- DECONNEXION --}}

    <div class="admin-sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="m-0"
        >

            @csrf

            <button
                type="submit"
                class="admin-logout-link"
            >

                <i class="bi bi-box-arrow-right"></i>

                <span>
                    Déconnexion
                </span>

            </button>

        </form>

    </div>

</aside>


{{-- =========================================================
     ZONE PRINCIPALE
========================================================== --}}

<div class="admin-main">


    {{-- =====================================================
         TOPBAR
    ====================================================== --}}

    <header class="admin-topbar">


        {{-- GAUCHE --}}

        <div class="admin-topbar-left">


            {{-- MOBILE --}}

            <button
                type="button"
                class="admin-mobile-button"
                id="adminMobileButton"
                aria-label="Ouvrir le menu"
            >

                <i class="bi bi-list"></i>

            </button>


            {{-- ICONE --}}

            <div class="admin-topbar-icon">

                <i class="bi bi-shield-check"></i>

            </div>


            {{-- TITRE --}}

            <div>

                <h2 class="admin-topbar-title">
                    Espace Administrateur
                </h2>

                <span class="admin-topbar-subtitle">
                    Plateforme de gestion des stages ABHOER
                </span>

            </div>

        </div>


        {{-- UTILISATEUR --}}

        <div class="admin-topbar-user">


            <div class="admin-topbar-user-info">

                <span class="admin-topbar-user-name">

                    @auth

                        {{ auth()->user()->prenom ?? auth()->user()->nom ?? 'Administrateur' }}

                    @else

                        Administrateur

                    @endauth

                </span>

                <span class="admin-topbar-user-role">
                    Administrateur
                </span>

            </div>


            <div class="admin-topbar-user-icon">

                <i class="bi bi-person-fill"></i>

            </div>

        </div>

    </header>


    {{-- =====================================================
         CONTENU
    ====================================================== --}}

    <main class="admin-page">


        {{-- PAGE HEADER --}}

        @hasSection('page-header')

            @yield('page-header')

        @else

            <div class="admin-page-header">

                <h1 class="admin-page-title">

                    @yield(
                        'page-title',
                        'Administration'
                    )

                </h1>

                <p class="admin-page-description">

                    @yield(
                        'page-description',
                        'Gestion et administration de la plateforme ABHOER.'
                    )

                </p>

            </div>

        @endif


        {{-- MESSAGES --}}

        @if(session('success'))

            <div
                class="alert alert-success admin-alert mb-4"
                role="alert"
            >

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div
                class="alert alert-danger admin-alert mb-4"
                role="alert"
            >

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                {{ session('error') }}

            </div>

        @endif


        {{-- CONTENU --}}

        <div class="admin-content">

            @yield('content')

        </div>

    </main>


    {{-- FOOTER --}}

    <footer class="admin-footer">

        ABHOER — Plateforme de gestion des stages

    </footer>

</div>
```

</div>

{{-- =============================================================
BOOTSTRAP
============================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

{{-- =============================================================
SIDEBAR MOBILE
============================================================= --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const button =
            document.getElementById('adminMobileButton');

        const sidebar =
            document.getElementById('adminSidebar');

        if (button && sidebar) {

            button.addEventListener('click', function () {

                sidebar.classList.toggle('show');

            });

        }

    });

</script>

@stack('scripts')

</body>

</html>
