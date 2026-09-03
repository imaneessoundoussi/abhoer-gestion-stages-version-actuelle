<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion - ABHOER</title>

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
            color: #10233f;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
        }

        /* =====================================================
           PARTIE GAUCHE
        ===================================================== */

        .auth-left {
            width: 50%;
            min-height: 100vh;

            position: relative;
            overflow: hidden;

            background-image:
                linear-gradient(
                    rgba(3, 60, 78, 0.48),
                    rgba(11, 139, 137, 0.58)
                ),
                url("{{ asset('images/bassin/barrage-1.jpeg') }}");

            background-size: cover;
            background-position: center;
        }

        .auth-left::after {
            content: "";
            position: absolute;
            inset: 0;

            background: linear-gradient(
                to bottom,
                rgba(3, 45, 70, 0.18),
                rgba(0, 125, 125, 0.20)
            );

            pointer-events: none;
        }

        /* =====================================================
           LOGO
        ===================================================== */

        .brand {
            position: absolute;
            top: 38px;
            left: 38px;
            z-index: 10;

            display: flex;
            align-items: center;
            gap: 11px;

            color: white;
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            background: white;
            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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
            font-weight: 500;

            color: rgba(255, 255, 255, 0.95);
        }

        /* =====================================================
           TEXTE GAUCHE
        ===================================================== */

        .welcome {
            position: absolute;

            left: 38px;
            right: 45px;
            bottom: 40px;

            z-index: 10;

            color: white;
        }

        .welcome h1 {
            font-size: 24px;
            font-weight: 700;

            margin-bottom: 12px;
        }

        .welcome p {
            max-width: 390px;

            font-size: 13px;
            line-height: 1.65;

            color: rgba(255, 255, 255, 0.95);
        }

        /* =====================================================
           PARTIE DROITE
        ===================================================== */

        .auth-right {
            width: 50%;
            min-height: 100vh;

            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 28px;
        }

        .login-header h2 {
            color: #10233f;

            font-size: 22px;
            font-weight: 700;

            margin-bottom: 7px;
        }

        .login-header p {
            color: #718096;

            font-size: 12px;
        }

        /* =====================================================
           MESSAGES
        ===================================================== */

        .success {
            background: #eaf8ef;

            border: 1px solid #b9e8cc;

            color: #16834b;

            padding: 11px 13px;

            border-radius: 7px;

            margin-bottom: 18px;

            font-size: 12px;
        }

        .error-box {
            background: #fff1f1;

            border: 1px solid #f2c3c3;

            color: #c53030;

            padding: 11px 13px;

            border-radius: 7px;

            margin-bottom: 18px;

            font-size: 12px;
        }

        /* =====================================================
           FORMULAIRE
        ===================================================== */

        .form-group {
            margin-bottom: 19px;
        }

        label {
            display: block;

            color: #23395d;

            font-size: 11px;
            font-weight: 600;

            margin-bottom: 7px;
        }

        input {
            width: 100%;
            height: 37px;

            padding: 0 12px;

            border: 1px solid #d8e0ea;

            border-radius: 7px;

            outline: none;

            background: #eaf2fd;

            color: #14213d;

            font-size: 12px;

            transition: 0.2s;
        }

        input:focus {
            border-color: #24a5a7;

            background: #f5faff;

            box-shadow:
                0 0 0 3px rgba(36, 165, 167, 0.10);
        }

        .error {
            color: #d93025;

            font-size: 10px;

            margin-top: 5px;
        }

        /* =====================================================
           BOUTON
        ===================================================== */

        .btn-login {
            width: 100%;
            height: 37px;

            border: none;
            border-radius: 8px;

            background: linear-gradient(
                90deg,
                #27a8aa,
                #087f7d
            );

            color: white;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 20px rgba(20, 139, 139, 0.20);

            transition: 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 24px rgba(20, 139, 139, 0.28);
        }

        /* =====================================================
           LIENS
        ===================================================== */

        .register-link {
            text-align: center;

            margin-top: 20px;

            color: #718096;

            font-size: 11px;
        }

        .register-link a {
            color: #087f7d;

            font-weight: 700;

            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-home {
            text-align: center;

            margin-top: 13px;
        }

        .back-home a {
            color: #8b9bb0;

            font-size: 11px;

            text-decoration: none;
        }

        .back-home a:hover {
            color: #087f7d;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 850px) {

            .auth-page {
                flex-direction: column;
            }

            .auth-left {
                width: 100%;
                min-height: 330px;
                height: 38vh;
            }

            .auth-right {
                width: 100%;
                min-height: 62vh;

                padding: 35px 25px;
            }

            .welcome {
                left: 25px;
                bottom: 25px;
            }

            .brand {
                top: 22px;
                left: 25px;
            }
        }

        @media (max-width: 500px) {

            .auth-left {
                min-height: 280px;
            }

            .auth-right {
                padding: 30px 20px;
            }

            .login-container {
                max-width: 100%;
            }
        }
    </style>

</head>


<body>

<div class="auth-page">

    <!-- =====================================================
         GAUCHE
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


        <div class="welcome">

            <h1>
                Bienvenue !
            </h1>

            <p>
                Connectez-vous pour accéder à votre espace personnel
                et suivre le traitement de vos demandes en toute simplicité.
            </p>

        </div>

    </section>


    <!-- =====================================================
         DROITE
    ===================================================== -->

    <section class="auth-right">

        <div class="login-container">

            <div class="login-header">

                <h2>
                    Connexion
                </h2>

                <p>
                    Accédez à votre espace ABHOER.
                </p>

            </div>


            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="error-box">
                    {{ session('error') }}
                </div>

            @endif


            <form
                method="POST"
                action="{{ route('login.submit') }}"
            >

                @csrf


                <!-- LOGIN -->

                <div class="form-group">

                    <label for="login">
                        Login
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


                <!-- MOT DE PASSE -->

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


                <!-- BOUTON -->

                <button
                    type="submit"
                    class="btn-login"
                >
                    ⇥ &nbsp; Se connecter
                </button>

            </form>


            <div class="register-link">

                Pas encore de compte ?

                <a href="{{ route('inscription') }}">
                    S'inscrire
                </a>

            </div>


            <div class="back-home">

                <a href="{{ route('accueil') }}">
                    ← Retour à l'accueil
                </a>

            </div>

        </div>

    </section>

</div>

</body>

</html>