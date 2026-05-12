# FundCampus

FundCampus est une plateforme Laravel de crowdfunding pour etudiants. Le projet respecte le cahier des charges du module Programmation Web 2 : architecture MVC, vues Blade, composants reutilisables, relations Eloquent, validation cote serveur, recherche et pagination.

## Fonctionnalites

- Pages statiques : accueil, a propos, contact.
- CRUD complet des etudiants porteurs de projets.
- CRUD complet des campagnes de financement.
- CRUD complet des contributions.
- Relations Eloquent :
  - un etudiant possede plusieurs campagnes ;
  - une campagne appartient a un etudiant ;
  - une campagne possede plusieurs contributions ;
  - une contribution appartient a une campagne et peut etre rattachee a un etudiant.
- Recherche et pagination sur les listes principales.
- Validation Laravel avec `request()->validate()`.
- Composants Blade : alerte, bouton, badge de statut.
- Donnees de demonstration via seeder.

## Repartition pour 2 membres

| Membre | Fonctionnalite responsable | Dossiers principaux |
| --- | --- | --- |
| wassimbenyakhlef0 | CRUD Etudiants, pages statiques, layout Blade | `StudentController`, `Student`, vues `students/*`, `layouts/*`, `home`, `about`, `contact` |
| houssemjemal54-art | CRUD Campagnes, CRUD Contributions, relations et seeders | `CampaignController`, `ContributionController`, `Campaign`, `Contribution`, vues `campaigns/*`, vues `contributions/*`, migrations, seeders |

Le projet contient trois CRUD alors que le groupe compte deux membres. Cela respecte la consigne, car le nombre de CRUD est superieur au nombre de membres et chaque membre garde au moins une fonctionnalite CRUD complete a presenter.

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

L'application sera disponible sur `http://127.0.0.1:8000`.

## Base de donnees phpMyAdmin

Le projet utilise MySQL avec XAMPP pour etre visible dans phpMyAdmin.

- Nom de la base : `crowdfunding_etudiants`
- Utilisateur local : `root`
- Mot de passe local : vide
- phpMyAdmin : `http://127.0.0.1/phpmyadmin/`

Un export SQL est disponible dans `database/crowdfunding_etudiants.sql`.

## Workflow GitHub demande

Chaque membre doit avoir des commits et pushs qui correspondent a sa fonctionnalite.

```bash
git log --oneline --decorate --all
```

Pour que les commits soient attribues correctement, chaque membre doit configurer son identite avant de committer :

```bash
git config user.name "Nom Prenom"
git config user.email "email-github@example.com"
```

## Verification rapide

```bash
php artisan test
```
