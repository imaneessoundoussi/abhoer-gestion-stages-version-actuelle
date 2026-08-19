<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Étudiant - ABHOER</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: #08608c;
            color: white;
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout button {
            background: white;
            color: #08608c;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .container {
            width: 92%;
            max-width: 1200px;
            margin: 35px auto;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h2 {
            margin-bottom: 8px;
        }

        .welcome p {
            color: #64748b;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            color: #08608c;
            margin-top: 0;
        }

        .card p {
            color: #64748b;
        }

        .button {
            display: inline-block;
            margin-top: 10px;
            background: #08608c;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <header class="header">

        <h1>
            ABHOER - Gestion des stages
        </h1>

        <form method="POST" action="{{ route('logout') }}" class="logout">
            @csrf

            <button type="submit">
                Se déconnecter
            </button>
        </form>

    </header>


    <main class="container">

        <div class="welcome">

            <h2>
                Bienvenue {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
            </h2>

            <p>
                Bienvenue dans votre espace étudiant.
            </p>

        </div>


        <div class="cards">

            <div class="card">

                <h3>Mon profil</h3>

                <p>
                    Consulter et modifier vos informations personnelles et académiques.
                </p>

                <a href="{{ route('etudiant.profil') }}" class="button">
                    Mon profil
                </a>

            </div>


            <div class="card">

                <h3>Nouvelle demande</h3>

                <p>
                    Créer une nouvelle demande de stage auprès de l'ABHOER.
                </p>

                <a href="{{ route('etudiant.demande.create') }}" class="button">
    Nouvelle demande de stage
</a>

            </div>


            <div class="card">

                <h3>Mes demandes</h3>

                <p>
                    Consulter l'état et l'historique de vos demandes de stage.
                </p>

                <a href="#" class="button">
                    Mes demandes
                </a>

            </div>

        </div>

    </main>

</body>

</html>