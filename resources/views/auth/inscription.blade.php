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

        body {
            min-height: 100vh;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
            color: #1e293b;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 850px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 45px;
            margin-bottom: 8px;
        }

        .header h1 {
            color: #123b70;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            color: #123b70;
            font-size: 17px;
            font-weight: bold;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .section-title span {
            font-size: 12px;
            color: #64748b;
            font-weight: normal;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
            color: #334155;
        }

        label .required {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d9dfe8;
            border-radius: 7px;
            outline: none;
            font-size: 13px;
            background: white;
            color: #1e293b;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #1261c9;
            box-shadow: 0 0 0 3px rgba(18, 97, 201, .08);
        }

        .help {
            display: block;
            margin-top: 5px;
            font-size: 11px;
            color: #64748b;
        }

        .error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .btn {
            border: none;
            border-radius: 7px;
            padding: 12px 22px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #1261c9;
            color: white;
        }

        .btn-primary:hover {
            background: #0f52aa;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .required-info {
            margin-top: 20px;
            color: #64748b;
            font-size: 11px;
        }

        @media (max-width: 650px) {

            .row {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }

            .card {
                padding: 25px 20px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</head>


<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div class="logo-icon">
            💧
        </div>

        <h1>
            ABHOER - Gestion des stages
        </h1>

        <p>
            Créer un compte étudiant
        </p>

        <p style="margin-top: 6px;">
            Remplissez le formulaire ci-dessous pour créer votre compte étudiant.
        </p>

    </div>


    <!-- FORMULAIRE -->

    <div class="card">

        <form
            method="POST"
            action="{{ route('inscription.store') }}"
        >

            @csrf


            <!-- ===================================================== -->
            <!-- INFORMATIONS PERSONNELLES -->
            <!-- ===================================================== -->

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
                            required
                            placeholder="Ex : AB123456"
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


                    <!-- DATE DE NAISSANCE -->

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

                    <div class="form-group">

                        <label>
                            Adresse email <span class="required">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="exemple@email.com"
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


            <!-- ===================================================== -->
            <!-- INFORMATIONS UNIVERSITAIRES -->
            <!-- ===================================================== -->

            <div class="section">

                <div class="section-title">
                    Informations universitaires
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


                    <!-- ANNEE UNIVERSITAIRE -->

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


            <!-- ===================================================== -->
            <!-- INFORMATIONS DU COMPTE -->
            <!-- ===================================================== -->

            <div class="section">

                <div class="section-title">
                    Informations du compte
                </div>


                <div class="row">

                    <!-- LOGIN -->

                    <div class="form-group full">

                        <label>
                            Login <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="login"
                            value="{{ old('login') }}"
                            required
                            placeholder="Choisissez votre identifiant"
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
                            Mot de passe <span class="required">*</span>
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
                            Confirmer le mot de passe <span class="required">*</span>
                        </label>

                        <input
                            type="password"
                            name="motDePasse_confirmation"
                            required
                        >

                    </div>

                </div>

            </div>


            <!-- ACTIONS -->

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
                    Créer mon compte
                </button>

            </div>


            <div class="required-info">
                * Champs obligatoires.
            </div>

        </form>

    </div>

</div>

</body>

</html>