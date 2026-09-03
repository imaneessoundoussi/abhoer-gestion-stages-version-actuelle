<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Créer un compte - ABHOER</title>


    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;

            background: #ffffff;

            color: #172b4d;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .auth-page {
            min-height: 100vh;

            display: flex;
        }


        /* =====================================================
           PARTIE GAUCHE
        ===================================================== */

        .auth-left {
            width: 46%;

            min-height: 100vh;

            position: fixed;

            left: 0;
            top: 0;

            overflow: hidden;

            background-image:
                linear-gradient(
                    rgba(3, 62, 83, 0.48),
                    rgba(15, 139, 132, 0.58)
                ),
                url("{{ asset('images/bassin/carte-bassin.png') }}");

            background-size: cover;

            background-position: center;
        }

        .auth-left::after {
            content: "";

            position: absolute;

            inset: 0;

            background: linear-gradient(
                to bottom,
                rgba(3, 36, 71, 0.18),
                rgba(11, 139, 135, 0.25)
            );

            pointer-events: none;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .brand {
            position: absolute;

            top: 38px;
            left: 40px;

            z-index: 10;

            display: flex;

            align-items: center;

            gap: 11px;

            color: white;
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            border-radius: 9px;

            background: white;

            display: flex;

            align-items: center;
            justify-content: center;

            overflow: hidden;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.18);
        }

        .brand-logo span {
            font-size: 22px;
        }

        .brand-text strong {
            display: block;

            font-size: 16px;

            font-weight: 700;
        }

        .brand-text small {
            display: block;

            margin-top: 3px;

            font-size: 9px;

            color: rgba(255, 255, 255, 0.95);
        }


        /* =====================================================
           TEXTE GAUCHE
        ===================================================== */

        .left-content {
            position: absolute;

            z-index: 10;

            left: 40px;
            right: 45px;
            bottom: 55px;

            color: white;
        }

        .left-content h1 {
            font-size: 24px;

            margin-bottom: 12px;
        }

        .left-content p {
            max-width: 370px;

            font-size: 13px;

            line-height: 1.65;

            margin-bottom: 20px;
        }


        /* =====================================================
           AVANTAGES
        ===================================================== */

        .features {
            display: flex;

            flex-direction: column;

            gap: 11px;
        }

        .feature {
            display: flex;

            align-items: center;

            gap: 9px;

            font-size: 11px;

            font-weight: 600;
        }

        .feature-icon {
            width: 24px;
            height: 24px;

            border-radius: 6px;

            background: rgba(255, 255, 255, 0.88);

            color: #078685;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 11px;
        }


        /* =====================================================
           PARTIE DROITE
        ===================================================== */

        .auth-right {
            width: 54%;

            margin-left: 46%;

            min-height: 100vh;

            background: #ffffff;

            padding: 38px 55px;
        }

        .register-container {
            width: 100%;

            max-width: 620px;

            margin: auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .register-header {
            margin-bottom: 25px;
        }

        .register-header h1 {
            font-size: 22px;

            color: #10233f;

            margin-bottom: 7px;
        }

        .register-header p {
            color: #718096;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =====================================================
           SECTIONS
        ===================================================== */

        .section {
            margin-bottom: 24px;
        }

        .section-title {
            color: #087f7d;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.3px;

            padding-bottom: 9px;

            margin-bottom: 15px;

            border-bottom: 1px solid #edf1f5;
        }


        /* =====================================================
           GRID
        ===================================================== */

        .row {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 0 14px;
        }

        .full {
            grid-column: 1 / -1;
        }


        /* =====================================================
           CHAMPS
        ===================================================== */

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;

            color: #23395d;

            font-size: 10px;

            font-weight: 600;

            margin-bottom: 6px;
        }

        .required {
            color: #e05252;
        }

        input,
        textarea,
        select {
            width: 100%;

            border: 1px solid #d7e0ea;

            border-radius: 7px;

            background: #ffffff;

            color: #172b4d;

            outline: none;

            font-size: 11px;

            transition: 0.2s;
        }

        input {
            height: 36px;

            padding: 0 11px;
        }

        textarea {
            min-height: 65px;

            padding: 10px 11px;

            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #1da5a5;

            box-shadow:
                0 0 0 3px rgba(29, 165, 165, 0.08);
        }

        .help {
            display: block;

            color: #8492a6;

            font-size: 9px;

            margin-top: 4px;
        }

        .error {
            color: #d93025;

            font-size: 9px;

            margin-top: 4px;
        }


        /* =====================================================
           BOUTONS
        ===================================================== */

        .actions {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-top: 5px;
        }

        .btn {
            height: 38px;

            border-radius: 7px;

            border: none;

            padding: 0 20px;

            font-size: 11px;

            font-weight: 700;

            text-decoration: none;

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            transition: 0.2s;
        }

        .btn-secondary {
            background: #f1f4f7;

            color: #617083;
        }

        .btn-secondary:hover {
            background: #e5eaf0;
        }

        .btn-primary {
            flex: 1;

            color: white;

            background: linear-gradient(
                90deg,
                #27a7aa,
                #087f7d
            );

            box-shadow:
                0 8px 18px rgba(20, 139, 139, 0.18);
        }

        .btn-primary:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 22px rgba(20, 139, 139, 0.25);
        }


        /* =====================================================
           NOTE
        ===================================================== */

        .required-info {
            margin-top: 10px;

            color: #8996a8;

            font-size: 9px;
        }


        /* =====================================================
           CONNEXION
        ===================================================== */

        .login-link {
            text-align: center;

            margin-top: 16px;

            color: #718096;

            font-size: 10px;
        }

        .login-link a {
            color: #087f7d;

            font-weight: 700;

            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 950px) {

            .auth-page {
                flex-direction: column;
            }

            .auth-left {
                position: relative;

                width: 100%;

                min-height: 330px;

                height: 330px;
            }

            .auth-right {
                width: 100%;

                margin-left: 0;

                padding: 35px 25px;
            }

            .register-container {
                max-width: 700px;
            }
        }


        @media (max-width: 600px) {

            .auth-left {
                min-height: 280px;

                height: 280px;
            }

            .brand {
                top: 22px;

                left: 22px;
            }

            .left-content {
                left: 22px;

                bottom: 25px;
            }

            .left-content h1 {
                font-size: 21px;
            }

            .row {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .auth-right {
                padding: 30px 18px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }
        }

    </style>

</head>


<body>


<div class="auth-page">


    <!-- =====================================================
         PARTIE GAUCHE
    ===================================================== -->

    <section class="auth-left">


        <div class="brand">

            <div class="brand-logo">
                <span>💧</span>
            </div>


            <div class="brand-text">

                <strong>
                    ABHOER
                </strong>

                <small>
                    Bassin Hydraulique de l'Oum Er-Rbia
                </small>

            </div>

        </div>


        <div class="left-content">

            <h1>
                Rejoignez-nous
            </h1>

            <p>
                Créez votre compte étudiant pour déposer votre
                demande de stage et suivre son traitement en temps réel.
            </p>


            <div class="features">

                <div class="feature">

                    <div class="feature-icon">
                        ✓
                    </div>

                    <span>
                        Dépôt de demande 100% en ligne
                    </span>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        ●
                    </div>

                    <span>
                        Suivi en temps réel du statut
                    </span>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        ✓
                    </div>

                    <span>
                        Attestation dématérialisée
                    </span>

                </div>

            </div>

        </div>

    </section>



    <!-- =====================================================
         PARTIE DROITE
    ===================================================== -->

    <section class="auth-right">


        <div class="register-container">


            <div class="register-header">

                <h1>
                    Créer votre compte
                </h1>

                <p>
                    Renseignez vos informations pour accéder à l'espace étudiant.
                </p>

            </div>



            <form
                method="POST"
                action="{{ route('inscription.store') }}"
            >

                @csrf


                <!-- =================================================
                     INFORMATIONS PERSONNELLES
                ================================================= -->

                <div class="section">

                    <div class="section-title">
                        Informations personnelles
                    </div>


                    <div class="row">


                        <!-- NOM -->

                        <div class="form-group">

                            <label>
                                Nom <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nom"
                                value="{{ old('nom') }}"
                                required
                            >

                            @error('nom')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- PRENOM -->

                        <div class="form-group">

                            <label>
                                Prénom <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="prenom"
                                value="{{ old('prenom') }}"
                                required
                            >

                            @error('prenom')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- CIN -->

                        <div class="form-group">

                            <label>
                                CIN <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="cin"
                                value="{{ old('cin') }}"
                                placeholder="Ex : AB123456"
                                required
                            >

                            @error('cin')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- CNE -->

                        <div class="form-group">

                            <label>
                                CNE
                            </label>

                            <input
                                type="text"
                                name="cne"
                                value="{{ old('cne') }}"
                                placeholder="Ex : G123456789"
                            >

                            <span class="help">
                                Votre Code National de l'Étudiant.
                            </span>

                            @error('cne')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- DATE NAISSANCE -->

                        <div class="form-group">

                            <label>
                                Date de naissance
                            </label>

                            <input
                                type="date"
                                name="dateNaissance"
                                value="{{ old('dateNaissance') }}"
                            >

                            @error('dateNaissance')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- TELEPHONE -->

                        <div class="form-group">

                            <label>
                                Téléphone
                            </label>

                            <input
                                type="text"
                                name="telephone"
                                value="{{ old('telephone') }}"
                                placeholder="Ex : 06XXXXXXXX"
                            >

                            @error('telephone')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- EMAIL -->

                        <div class="form-group full">

                            <label>
                                Adresse email
                                <span class="required">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="exemple@email.com"
                                required
                            >

                            @error('email')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- ADRESSE -->

                        <div class="form-group full">

                            <label>
                                Adresse
                            </label>

                            <textarea
                                name="adresse"
                                placeholder="Votre adresse"
                            >{{ old('adresse') }}</textarea>

                            @error('adresse')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     PARCOURS ACADEMIQUE
                ================================================= -->

                <div class="section">

                    <div class="section-title">
                        Parcours académique
                    </div>


                    <div class="row">


                        <!-- ETABLISSEMENT -->

                        <div class="form-group">

                            <label>
                                Établissement
                            </label>

                            <input
                                type="text"
                                name="etablissement"
                                value="{{ old('etablissement') }}"
                                placeholder="Ex : Faculté Polydisciplinaire"
                            >

                            @error('etablissement')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- FORMATION -->

                        <div class="form-group">

                            <label>
                                Formation
                            </label>

                            <input
                                type="text"
                                name="formation"
                                value="{{ old('formation') }}"
                                placeholder="Ex : MIACSD"
                            >

                            @error('formation')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- NIVEAU -->

                        <div class="form-group">

                            <label>
                                Niveau d'étude
                            </label>

                            <input
                                type="text"
                                name="niveauEtude"
                                value="{{ old('niveauEtude') }}"
                                placeholder="Ex : Licence / S6"
                            >

                            @error('niveauEtude')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- ANNEE -->

                        <div class="form-group">

                            <label>
                                Année universitaire
                            </label>

                            <input
                                type="text"
                                name="anneeUniversitaire"
                                value="{{ old('anneeUniversitaire') }}"
                                placeholder="Ex : 2025-2026"
                            >

                            @error('anneeUniversitaire')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     IDENTIFIANTS
                ================================================= -->

                <div class="section">

                    <div class="section-title">
                        Identifiants de connexion
                    </div>


                    <div class="row">


                        <!-- LOGIN -->

                        <div class="form-group full">

                            <label>
                                Login
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="login"
                                value="{{ old('login') }}"
                                placeholder="Choisissez votre identifiant"
                                required
                            >

                            @error('login')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- MOT DE PASSE -->

                        <div class="form-group">

                            <label>
                                Mot de passe
                                <span class="required">*</span>
                            </label>

                            <input
                                type="password"
                                name="motDePasse"
                                required
                            >

                            @error('motDePasse')

                                <div class="error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- CONFIRMATION -->

                        <div class="form-group">

                            <label>
                                Confirmer le mot de passe
                                <span class="required">*</span>
                            </label>

                            <input
                                type="password"
                                name="motDePasse_confirmation"
                                required
                            >

                        </div>

                    </div>

                </div>



                <!-- =================================================
                     ACTIONS
                ================================================= -->

                <div class="actions">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-secondary"
                    >
                        ← Retour à la connexion
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        👤 &nbsp; Créer mon compte
                    </button>

                </div>


                <div class="required-info">
                    * Champs obligatoires.
                </div>

            </form>


            <div class="login-link">

                Déjà un compte ?

                <a href="{{ route('login') }}">
                    Se connecter
                </a>

            </div>


        </div>

    </section>

</div>


</body>

</html>