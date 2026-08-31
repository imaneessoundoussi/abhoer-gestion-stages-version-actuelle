<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Ajouter un utilisateur - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #333;
            min-height: 100vh;
        }

        /* =====================================================
           NAVBAR
        ====================================================== */

        .navbar {
            background: linear-gradient(
                135deg,
                #1a7a86,
                #2fa9b0
            );

            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-logo {
            height: 42px;
            width: auto;

            background: white;
            border-radius: 8px;

            padding: 3px 6px;
        }

        .navbar-brand h1 {
            font-size: 19px;
            line-height: 1.1;
        }

        .navbar-subtitle {
            display: block;

            font-size: 11px;
            opacity: 0.85;

            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        .navbar-links a:hover {
            text-decoration: underline;
        }

        /* =====================================================
           VAGUE
        ====================================================== */

        .wave-divider {
            line-height: 0;
            margin-top: -1px;
        }

        .wave-divider svg {
            width: 100%;
            height: 26px;
            display: block;
        }

        /* =====================================================
           CONTENEUR
        ====================================================== */

        .container {
            max-width: 1000px;
            margin: 0 auto;

            padding: 35px 30px 50px;
        }

        /* =====================================================
           HEADER
        ====================================================== */

        .header {
            margin-bottom: 25px;
        }

        .header h2 {
            color: #1a7a86;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 15px;
        }

        /* =====================================================
           CARTE
        ====================================================== */

        .card {
            background: white;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.08);

            padding: 30px;
        }

        /* =====================================================
           FORMULAIRE
        ====================================================== */

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: bold;

            color: #374151;

            margin-bottom: 8px;
        }

        .required {
            color: #dc2626;
        }

        input,
        select {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #d1d5db;

            border-radius: 7px;

            font-size: 14px;

            background: white;

            color: #333;

            outline: none;

            transition:
                border-color 0.2s,
                box-shadow 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #1a7a86;

            box-shadow:
                0 0 0 3px
                rgba(26, 122, 134, 0.12);
        }

        .help-text {
            margin-top: 6px;

            font-size: 12px;

            color: #6b7280;
        }

        /* =====================================================
           MESSAGES
        ====================================================== */

        .message {
            padding: 13px 16px;

            border-radius: 7px;

            margin-bottom: 22px;

            font-size: 14px;
        }

        .message-error {
            background: #fee2e2;
            color: #991b1b;

            border: 1px solid #fecaca;
        }

        .message-error strong {
            display: block;

            margin-bottom: 8px;
        }

        .message-error ul {
            margin-left: 20px;
        }

        .message-error li {
            margin-bottom: 4px;
        }

        /* =====================================================
           ACTIONS
        ====================================================== */

        .form-actions {
            display: flex;

            justify-content: flex-end;

            align-items: center;

            gap: 12px;

            margin-top: 30px;

            padding-top: 22px;

            border-top: 1px solid #eee;
        }

        .btn {
            display: inline-block;

            padding: 11px 18px;

            border-radius: 7px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-weight: bold;

            font-size: 14px;

            transition:
                background 0.2s,
                transform 0.1s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #1a7a86;
            color: white;
        }

        .btn-primary:hover {
            background: #14636d;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        /* =====================================================
           NOTE
        ====================================================== */

        .info-box {
            background: #eff6ff;

            border: 1px solid #bfdbfe;

            color: #1e40af;

            border-radius: 7px;

            padding: 13px 15px;

            margin-bottom: 25px;

            font-size: 13px;

            line-height: 1.5;
        }

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 768px) {

            .navbar {
                padding: 15px;

                flex-direction: column;

                gap: 15px;

                align-items: flex-start;
            }

            .navbar-links {
                width: 100%;

                flex-wrap: wrap;

                gap: 12px;
            }

            .container {
                padding:
                    25px 15px 40px;
            }

            .header h2 {
                font-size: 23px;
            }

            .card {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;

                align-items: stretch;
            }

            .form-actions .btn {
                width: 100%;

                text-align: center;
            }
        }
    </style>
</head>

<body>

    {{-- =====================================================
         NAVBAR
    ====================================================== --}}

    <div class="navbar">

        <div class="navbar-brand">

            <img
                src="{{ asset('images/logo-abhoer.png') }}"
                alt="Logo ABHOER"
                class="navbar-logo"
            >

            <div>

                <h1>
                    ABHOER
                </h1>

                <span class="navbar-subtitle">
                    Gestion des stages
                </span>

            </div>

        </div>

        <div class="navbar-links">

            <a href="{{ route('admin.dashboard') }}">
                Tableau de bord
            </a>

            <a href="{{ route('admin.utilisateurs.index') }}">
                Utilisateurs
            </a>

            <a
                href="{{ route('logout') }}"
                onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                "
            >
                Déconnexion
            </a>

            <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;"
            >
                @csrf
            </form>

        </div>

    </div>


    {{-- =====================================================
         VAGUE
    ====================================================== --}}

    <div class="wave-divider">

        <svg
            viewBox="0 0 1440 40"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
        >

            <path
                fill="#9bd9d6"
                d="M0,20 C240,40 480,0 720,15 C960,30 1200,5 1440,20 L1440,40 L0,40 Z"
            ></path>

        </svg>

    </div>


    {{-- =====================================================
         CONTENU
    ====================================================== --}}

    <div class="container">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="header">

            <h2>
                Ajouter un utilisateur
            </h2>

            <p>
                Créer un nouveau compte utilisateur dans le système ABHOER.
            </p>

        </div>


        {{-- =================================================
             ERREURS DE VALIDATION
        ================================================== --}}

        @if($errors->any())

            <div class="message message-error">

                <strong>
                    Impossible de créer l'utilisateur.
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =================================================
             INFORMATION
        ================================================== --}}

        <div class="info-box">

            <strong>Information :</strong>

            Le mot de passe sera automatiquement
            enregistré de manière sécurisée.
            Le compte créé sera actif par défaut.

        </div>


        {{-- =================================================
             CARTE FORMULAIRE
        ================================================== --}}

        <div class="card">

            <form
                action="{{ route('admin.utilisateurs.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">


                    {{-- =====================================
                         NOM
                    ====================================== --}}

                    <div class="form-group">

                        <label for="nom">
                            Nom
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom') }}"
                            maxlength="100"
                            required
                            autocomplete="family-name"
                            placeholder="Ex. EL AMRANI"
                        >

                    </div>


                    {{-- =====================================
                         PRÉNOM
                    ====================================== --}}

                    <div class="form-group">

                        <label for="prenom">
                            Prénom
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="prenom"
                            name="prenom"
                            value="{{ old('prenom') }}"
                            maxlength="100"
                            required
                            autocomplete="given-name"
                            placeholder="Ex. Mohamed"
                        >

                    </div>


                    {{-- =====================================
                         LOGIN
                    ====================================== --}}

                    <div class="form-group full">

                        <label for="login">
                            Login
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="login"
                            name="login"
                            value="{{ old('login') }}"
                            maxlength="100"
                            required
                            autocomplete="username"
                            placeholder="Ex. mohamed.elamrani"
                        >

                        <span class="help-text">
                            Le login doit être unique dans le système.
                        </span>

                    </div>


                    {{-- =====================================
                         MOT DE PASSE
                    ====================================== --}}

                    <div class="form-group">

                        <label for="motDePasse">
                            Mot de passe
                            <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            id="motDePasse"
                            name="motDePasse"
                            minlength="6"
                            required
                            autocomplete="new-password"
                            placeholder="Minimum 6 caractères"
                        >

                    </div>


                    {{-- =====================================
                         CONFIRMATION MOT DE PASSE
                    ====================================== --}}

                    <div class="form-group">

                        <label for="motDePasse_confirmation">
                            Confirmer le mot de passe
                            <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            id="motDePasse_confirmation"
                            name="motDePasse_confirmation"
                            minlength="6"
                            required
                            autocomplete="new-password"
                            placeholder="Retapez le mot de passe"
                        >

                    </div>


                    {{-- =====================================
                         RÔLE
                    ====================================== --}}

                    <div class="form-group full">

                        <label for="role">
                            Rôle
                            <span class="required">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            required
                        >

                            <option value="">
                                -- Sélectionner un rôle --
                            </option>

                            <option
                                value="ETUDIANT"
                                {{ old('role') === 'ETUDIANT' ? 'selected' : '' }}
                            >
                                Étudiant
                            </option>

                            <option
                                value="RESPONSABLE"
                                {{ old('role') === 'RESPONSABLE' ? 'selected' : '' }}
                            >
                                Responsable
                            </option>

                            <option
                                value="ADMINISTRATEUR"
                                {{ old('role') === 'ADMINISTRATEUR' ? 'selected' : '' }}
                            >
                                Administrateur
                            </option>

                        </select>

                        <span class="help-text">
                            Le rôle détermine les droits d'accès
                            de l'utilisateur dans l'application.
                        </span>

                    </div>


                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="form-actions">

                    <a
                        href="{{ route('admin.utilisateurs.index') }}"
                        class="btn btn-secondary"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Créer l'utilisateur
                    </button>

                </div>


            </form>

        </div>

    </div>

</body>
</html>
