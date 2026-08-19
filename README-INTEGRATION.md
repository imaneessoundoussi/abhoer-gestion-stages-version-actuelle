# Intégration — Départements/Services (organigramme) + Type de stage/Thème

## 1. Fichier nouveau : la migration
- `database/migrations/2026_08_19_102710_add_type_stage_and_theme_to_demande_stage_table.php`
  → copie-la dans `database/migrations/`, puis lance :
```bash
php artisan migrate
```
Ça ajoute 2 colonnes (`typeStage`, `theme`) à la table `demande_stage`, sans toucher aux données existantes.

## 2. Fichier nouveau : le seeder
- `database/seeders/DepartementServiceSeeder.php` → copie-le dans `database/seeders/`

Puis lance-le pour peupler la base avec l'organigramme (Secrétariat Général + 4 Divisions + Délégation, et tous leurs services) :
```bash
php artisan db:seed --class=DepartementServiceSeeder
```
Il utilise `firstOrCreate`, donc tu peux le relancer sans créer de doublons.

## 3. Fichiers modifiés (remplace entièrement)
- `app/Models/DemandeStage.php` → ajout de `typeStage` et `theme` au `$fillable`
- `app/Http/Controllers/Responsable/ResponsableDemandeController.php` → validation + sauvegarde des 2 nouveaux champs, services groupés par département
- `resources/views/responsable/demandes/create.blade.php` → nouveau champ "Type de stage" (select) + "Thème / Sujet" (texte), select de service maintenant regroupé par département (optgroup)
- `resources/views/responsable/demandes/show.blade.php` → affichage du type de stage et du thème dans le détail

## Après copie, dans l'ordre
```bash
php artisan migrate
php artisan db:seed --class=DepartementServiceSeeder
composer dump-autoload
php artisan view:clear
```

## Test
1. Va sur "Nouvelle demande (physique)"
2. Le menu déroulant "Service demandé" doit maintenant afficher tes départements comme groupes (Secrétariat Général, Division Administrative et Financière, etc.) avec leurs services dedans
3. Remplis "Type de stage" (obligatoire) et "Thème" (optionnel)
4. Valide et vérifie que ces 2 infos apparaissent bien sur la page de détail de la demande créée
