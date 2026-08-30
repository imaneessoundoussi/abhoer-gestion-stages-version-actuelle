<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Connexion - ABHOER</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .box {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            font-size: 45px;
        }

        h1 {
            color: #123b70;
            font-size: 24px;
            margin-top: 5px;
        }

        .subtitle {
            color: #777;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9dfe8;
            border-radius: 7px;
            outline: none;
        }

        input:focus {
            border-color: #1261c9;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #1261c9;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn:hover {
            background: #0d50a8;
        }

        .error {
            color: #d93025;
            font-size: 11px;
            margin-top: 5px;
        }

        .success {
            background: #eaf8ef;
            border: 1px solid #b9e8cc;
            color: #16834b;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .register {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .register a {
            color: #1261c9;
            font-weight: bold;
            text-decoration: none;
        }

    </style>

</head>


<body>

<div class="box">

    <div class="logo">

        <div class="logo-icon">
            💧
        </div>

        <h1>
            ABHOER
        </h1>

        <p class="subtitle">
            Plateforme de gestion des stages
        </p>

    </div>


    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="error" style="margin-bottom:15px;">
            {{ session('error') }}
        </div>

    @endif


    <form
        method="POST"
        action="{{ route('login.submit') }}"
    >

        @csrf


        <div class="form-group">

            <label for="login">
                Identifiant
            </label>

            <input
                id="login"
                type="text"
                name="login"
                value="{{ old('login') }}"
                required
                autofocus
            >

            @error('login')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <div class="form-group">

            <label for="motDePasse">
                Mot de passe
            </label>

            <input
                id="motDePasse"
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


        <button
            type="submit"
            class="btn"
        >
            Se connecter
        </button>

    </form>


    <div class="register">

        Vous n'avez pas encore de compte ?

        <a href="{{ route('inscription') }}">
            Créer un compte
        </a>

    </div>

</div>

</body>

</html>