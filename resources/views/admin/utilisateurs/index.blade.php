<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Utilisateurs - ABHOER</title>

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
            padding: 30px;
            max-width: 1400px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .header h2 {
            color: #075985;
            font-size: 28px;
        }

        .subtitle {
            color: #64748b;
            margin-top: 6px;
        }

        .btn {
            display: inline-block;

            padding: 10px 16px;

            border-radius: 7px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-weight: bold;

            font-size: 14px;
        }

        .btn-primary {
            background: #075985;
            color: white;
        }

        .btn-primary:hover {
            background: #064e73;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-success {
            background: #16a34a;
            color: white;
        }

        .btn-secondary {
            background: #64748b;
            color: white;
        }

        .message {
            padding: 14px 18px;

            border-radius: 8px;

            margin-bottom: 20px;

            font-weight: bold;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .table-container {
            background: white;

            border-radius: 12px;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, 0.08);

            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;

            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #075985;
            color: white;

            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;

            padding: 6px 11px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-role {
            background: #e0f2fe;
            color: #075985;
        }

        .actions {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .actions form {
            display: inline;
        }

        .empty {
            text-align: center;

            padding: 50px;

            color: #64748b;
        }

        .back {
            margin-bottom: 20px;
        }

        @media (max-width: 800px) {

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .container {
                padding: 15px;
            }

        }

    </style>

</head>


<body>


    <!-- NAVBAR -->

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
                style="display: none;"
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


    <!-- CONTENU -->

    <div class="container">


        <div class="back">

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-secondary"
            >
                ← Retour au tableau de bord
            </a>

        </div>


        <!-- HEADER -->

        <div class="header">

            <div>

                <h2>
                    Gestion des utilisateurs
                </h2>

                <p class="subtitle">
                    Gérez les comptes utilisateurs de l'application ABHOER.
                </p>

            </div>


            <a
                href="{{ route('admin.utilisateurs.create') }}"
                class="btn btn-primary"
            >
                + Ajouter un utilisateur
            </a>

        </div>


        <!-- MESSAGE SUCCÈS -->

        @if(session('success'))

            <div class="message success">

                {{ session('success') }}

            </div>

        @endif


        <!-- MESSAGE ERREUR -->

        @if(session('error'))

            <div class="message error">

                {{ session('error') }}

            </div>

        @endif


        <!-- TABLEAU -->

        <div class="table-container">

            @if($utilisateurs->count() > 0)

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Nom
                            </th>

                            <th>
                                Prénom
                            </th>

                            <th>
                                Login
                            </th>

                            <th>
                                Rôle
                            </th>

                            <th>
                                État
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($utilisateurs as $utilisateur)

                            <tr>

                                <td>
                                    {{ $utilisateur->idUtilisateur }}
                                </td>


                                <td>
                                    {{ $utilisateur->nom }}
                                </td>


                                <td>
                                    {{ $utilisateur->prenom }}
                                </td>


                                <td>
                                    {{ $utilisateur->login }}
                                </td>


                                <td>

                                    <span class="badge badge-role">

                                        {{ $utilisateur->role }}

                                    </span>

                                </td>


                                <td>

                                    @if($utilisateur->actif)

                                        <span class="badge badge-active">
                                            Actif
                                        </span>

                                    @else

                                        <span class="badge badge-inactive">
                                            Inactif
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="actions">


                                        <!-- MODIFIER -->

                                        <a
                                            href="{{ route(
                                                'admin.utilisateurs.edit',
                                                $utilisateur->idUtilisateur
                                            ) }}"
                                            class="btn btn-warning"
                                        >
                                            Modifier
                                        </a>


                                        <!-- ACTIVER / DESACTIVER -->

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.utilisateurs.toggle',
                                                $utilisateur->idUtilisateur
                                            ) }}"
                                        >

                                            @csrf

                                            @method('PUT')


                                            @if($utilisateur->actif)

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                    onclick="
                                                        return confirm(
                                                            'Voulez-vous désactiver cet utilisateur ?'
                                                        );
                                                    "
                                                >
                                                    Désactiver
                                                </button>

                                            @else

                                                <button
                                                    type="submit"
                                                    class="btn btn-success"
                                                >
                                                    Activer
                                                </button>

                                            @endif

                                        </form>


                                        <!-- SUPPRIMER -->

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.utilisateurs.destroy',
                                                $utilisateur->idUtilisateur
                                            ) }}"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                                onclick="
                                                    return confirm(
                                                        'Êtes-vous sûr de vouloir supprimer cet utilisateur ?'
                                                    );
                                                "
                                            >
                                                Supprimer
                                            </button>

                                        </form>


                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">

                    <h3>
                        Aucun utilisateur trouvé
                    </h3>

                    <p>
                        Aucun compte utilisateur n'est actuellement enregistré.
                    </p>

                </div>

            @endif

        </div>

    </div>

</body>

</html>