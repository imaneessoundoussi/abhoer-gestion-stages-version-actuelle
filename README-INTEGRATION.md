# Intégration — Suivi des stages + Historique complet

## Fichiers nouveaux (à copier tels quels)
- `app/Http/Controllers/Responsable/ResponsableHistoriqueController.php`
- `app/Http/Controllers/Responsable/ResponsableStageController.php`
- `resources/views/responsable/historique/index.blade.php`
- `resources/views/responsable/stages/index.blade.php`

## Fichiers modifiés (remplace-les entièrement, ils contiennent déjà tout le contenu précédent + les ajouts)
- `routes/web.php` → ajout des routes `/responsable/stages` et `/responsable/historique`
- `resources/views/responsable/dashboard.blade.php`
- `resources/views/responsable/demandes/index.blade.php`
- `resources/views/responsable/demandes/show.blade.php`
- `resources/views/responsable/demandes/create.blade.php`
  → ces 4 vues ont juste 2 liens de menu ajoutés ("Suivi des stages" et "Historique")

## Après copie
```bash
composer dump-autoload
```
(pas besoin de `storage:link` ni de migration, aucune nouvelle table)

## Test rapide
1. Connecte-toi en RESPONSABLE
2. Menu → **Suivi des stages** : 3 onglets (À venir / En cours / Terminés). Vide tant qu'aucune affectation n'existe — affecte une demande à un service depuis sa page de détail pour tester.
3. Menu → **Historique** : liste toutes les actions de toutes les demandes, avec filtres (recherche par n° demande, type d'action, utilisateur, dates).
