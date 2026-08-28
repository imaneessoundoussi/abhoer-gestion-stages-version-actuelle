<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modifier utilisateur - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #075985;
            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 22px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
        }

        .back {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .btn-primary {
            background: #075985;
            color: white;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
            padding: 30px;
        }

        h2 {
            color: #075985;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #075985;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox input {
            width: auto;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .password-info {
            background: #f1f5f9;
            border-radius: 7px;
            padding: 12px;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .container {
                padding: 15px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <div class="navbar">

        <h1>
            ABHOER - Gestion des stages
        </h1>

        <div class="navbar-links">

            <a href="{{ route('admin.dashboard') }}">
                Tableau de bord
            </a>

            <a href="{{ route('admin.utilisateurs.index') }}">
                Utilisateurs
            </a>

            <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display:none;"
            >
                @csrf
            </form>

            <a
                href="{{ route('logout') }}"
                onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                "
            >
                Déconnexion
            </a>

        </div>

    </div>


    {{-- CONTENU --}}
    <div class="container">

        <div class="back">

            <a
                href="{{ route('admin.utilisateurs.index') }}"
                class="btn btn-secondary"
            >
                ← Retour aux utilisateurs
            </a>

        </div>


        <div class="card">

            <h2>
                Modifier un utilisateur
            </h2>

            <p class="subtitle">
                Modifiez les informations du compte utilisateur.
            </p>


            {{-- ERREURS --}}
            @if($errors->any())

                <div
                    style="
                        background:#fee2e2;
                        color:#991b1b;
                        padding:15px;
                        border-radius:8px;
                        margin-bottom:20px;
                    "
                >

                    <strong>
                        Veuillez corriger les erreurs suivantes :
                    </strong>

                    <ul style="margin-top:8px; margin-left:20px;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORMULAIRE --}}
            <form
                method="POST"
                action="{{ route(
                    'admin.utilisateurs.update',
                    $utilisateur->idUtilisateur
                ) }}"
            >

                @csrf

                @method('PUT')


                <div class="row">

                    {{-- NOM --}}
                    <div class="form-group">

                        <label for="nom">
                            Nom *
                        </label>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom', $utilisateur->nom) }}"
                            required
                        >

                        @error('nom')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PRENOM --}}
                    <div class="form-group">

                        <label for="prenom">
                            Prénom *
                        </label>

                        <input
                            type="text"
                            id="prenom"
                            name="prenom"
                            value="{{ old('prenom', $utilisateur->prenom) }}"
                            required
                        >

                        @error('prenom')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- LOGIN --}}
                <div class="form-group">

                    <label for="login">
                        Login *
                    </label>

                    <input
                        type="text"
                        id="login"
                        name="login"
                        value="{{ old('login', $utilisateur->login) }}"
                        required
                    >

                    @error('login')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ROLE --}}
                <div class="form-group">

                    <label for="role">
                        Rôle *
                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                    >

                        <option
                            value="ETUDIANT"
                            {{ old('role', $utilisateur->role) === 'ETUDIANT' ? 'selected' : '' }}
                        >
                            Étudiant
                        </option>

                        <option
                            value="RESPONSABLE"
                            {{ old('role', $utilisateur->role) === 'RESPONSABLE' ? 'selected' : '' }}
                        >
                            Responsable
                        </option>

                        <option
                            value="ADMINISTRATEUR"
                            {{ old('role', $utilisateur->role) === 'ADMINISTRATEUR' ? 'selected' : '' }}
                        >
                            Administrateur
                        </option>

                    </select>

                    @error('role')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ETAT --}}
                <div class="form-group">

                    <label>
                        État du compte
                    </label>

                    <label class="checkbox">

                        <input
                            type="checkbox"
                            name="actif"
                            value="1"
                            {{ old('actif', $utilisateur->actif) ? 'checked' : '' }}
                        >

                        Compte actif

                    </label>

                </div>


                {{-- MOT DE PASSE --}}
                <div class="password-info">

                    Laissez les champs de mot de passe vides
                    si vous ne souhaitez pas modifier le mot de passe.

                </div>


                <div class="row">

                    <div class="form-group">

                        <label for="motDePasse">
                            Nouveau mot de passe
                        </label>

                        <input
                            type="password"
                            id="motDePasse"
                            name="motDePasse"
                            minlength="6"
                        >

                        @error('motDePasse')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="motDePasse_confirmation">
                            Confirmer le mot de passe
                        </label>

                        <input
                            type="password"
                            id="motDePasse_confirmation"
                            name="motDePasse_confirmation"
                            minlength="6"
                        >

                    </div>

                </div>


                {{-- ACTIONS --}}
                <div class="actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Enregistrer les modifications
                    </button>


                    <a
                        href="{{ route('admin.utilisateurs.index') }}"
                        class="btn btn-secondary"
                    >
                        Annuler
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>