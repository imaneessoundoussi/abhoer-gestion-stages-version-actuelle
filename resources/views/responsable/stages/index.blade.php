<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Suivi des stages - ABHOER</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f4f7fb; color: #333; }

        .navbar {
            background: #075985; color: white; padding: 18px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar h1 { font-size: 22px; }
        .navbar-right { display: flex; align-items: center; }
        .navbar nav a { color: white; text-decoration: none; margin-right: 20px; font-size: 14px; opacity: 0.9; }
        .navbar nav a:hover { opacity: 1; text-decoration: underline; }
        .logout button {
            background: white; color: #075985; border: none;
            padding: 9px 16px; border-radius: 6px; cursor: pointer; font-weight: bold;
        }

        .container { padding: 30px; }

        h2 { color: #075985; margin-bottom: 20px; }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .tab {
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            background: white;
            color: #075985;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .tab.active {
            background: #075985;
            color: white;
        }

        .tab .count {
            display: inline-block;
            margin-left: 6px;
            font-size: 12px;
            opacity: 0.85;
        }

        .table-section {
            background: white; border-radius: 10px; box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            padding: 25px; overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 8px; border-bottom: 1px solid #eee; font-size: 14px; }
        th { color: #666; font-size: 12px; text-transform: uppercase; }

        .link-detail { color: #075985; font-weight: bold; text-decoration: none; }

        .pagination-wrap { margin-top: 20px; }

        @media (max-width: 600px) {
            .tabs { flex-direction: column; }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>ABHOER - Espace Responsable</h1>

        <div class="navbar-right">
            <nav>
                <a href="{{ route('responsable.dashboard') }}">Tableau de bord</a>
                <a href="{{ route('responsable.demandes.index') }}">Demandes</a>
                <a href="{{ route('responsable.stages.index') }}">Suivi des stages</a>
                <a href="{{ route('responsable.historique.index') }}">Historique</a>
                <a href="{{ route('responsable.demandes.create') }}">Nouvelle demande (physique)</a>
            </nav>

            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        <h2>Suivi des stages</h2>

        <div class="tabs">
            <a href="{{ route('responsable.stages.index', ['statut' => 'a_venir']) }}" class="tab @if($onglet === 'a_venir') active @endif">
                À venir <span class="count">({{ $compteurs['a_venir'] }})</span>
            </a>
            <a href="{{ route('responsable.stages.index', ['statut' => 'en_cours']) }}" class="tab @if($onglet === 'en_cours') active @endif">
                En cours <span class="count">({{ $compteurs['en_cours'] }})</span>
            </a>
            <a href="{{ route('responsable.stages.index', ['statut' => 'termine']) }}" class="tab @if($onglet === 'termine') active @endif">
                Terminés <span class="count">({{ $compteurs['termine'] }})</span>
            </a>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>N° Demande</th>
                        <th>Stagiaire</th>
                        <th>Service</th>
                        <th>Début</th>
                        <th>Fin</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($affectations as $affectation)
                        <tr>
                            <td>{{ optional($affectation->demande)->numeroDemande }}</td>
                            <td>
                                {{ optional(optional($affectation->demande)->candidat)->prenom }}
                                {{ optional(optional($affectation->demande)->candidat)->nom }}
                            </td>
                            <td>{{ optional($affectation->service)->nomService ?? '—' }}</td>
                            <td>{{ optional($affectation->dateDebut)->format('d/m/Y') }}</td>
                            <td>{{ optional($affectation->dateFin)->format('d/m/Y') }}</td>
                            <td>
                                @if ($affectation->demande)
                                    <a href="{{ route('responsable.demandes.show', $affectation->demande->idDemande) }}" class="link-detail">
                                        Voir détails
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:#999;padding:25px;">Aucun stage dans cette catégorie.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $affectations->links() }}
            </div>
        </div>

    </div>

</body>

</html>
