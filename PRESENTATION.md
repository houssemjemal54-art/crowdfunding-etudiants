# Preparation au passage

## Verification avant presentation

- Lancer XAMPP : Apache et MySQL doivent etre demarres.
- Ouvrir phpMyAdmin : `http://127.0.0.1/phpmyadmin/`.
- Verifier la base `crowdfunding_etudiants`.
- Lancer Laravel :

```bash
php artisan serve
```

- Ouvrir l'application : `http://127.0.0.1:8000`.
- Ouvrir le code source dans VS Code depuis le dossier du projet.

## Structure Laravel a expliquer

- `routes/web.php` : contient les routes de navigation et les routes resource des CRUD.
- `app/Http/Controllers` : contient la logique des pages et des formulaires.
- `app/Models` : contient les modeles Eloquent et les relations entre les tables.
- `database/migrations` : contient la structure des tables.
- `database/seeders` : insere des donnees de demonstration.
- `resources/views` : contient les pages Blade affichees dans le navigateur.
- `public` : point d'entree public de l'application.
- `.env` : configuration locale, notamment la connexion MySQL.

## Concepts Laravel essentiels

- MVC : Laravel separe le modele, la vue et le controleur.
- Route : URL qui appelle une page ou une action.
- Controller : classe PHP qui traite la requete et retourne une vue.
- Model Eloquent : classe PHP liee a une table SQL.
- Migration : fichier PHP qui cree ou modifie une table.
- Seeder : fichier qui ajoute des donnees de test.
- Blade : moteur de templates pour ecrire les pages HTML.
- Validation : controle des champs avec `$request->validate()`.

## Wassim - partie a presenter

Fonctionnalites :

- CRUD complet des etudiants.
- Pages statiques : accueil, a propos, contact.
- Layout Blade commun et composants reutilisables.

Fichiers principaux :

- `app/Http/Controllers/StudentController.php`
- `app/Models/Student.php`
- `resources/views/students`
- `resources/views/layouts/app.blade.php`
- `resources/views/home.blade.php`
- `resources/views/about.blade.php`
- `resources/views/contact.blade.php`

Points a expliquer :

- Un etudiant est un porteur de projet.
- Le CRUD permet d'ajouter, afficher, modifier et supprimer un etudiant.
- Le modele `Student` possede une relation `hasMany` avec les campagnes.
- Les formulaires utilisent `@csrf` et la validation Laravel.

## Houssem - partie a presenter

Fonctionnalites :

- CRUD complet des campagnes.
- CRUD complet des contributions.
- Relations entre etudiants, campagnes et contributions.
- Donnees de demonstration et base MySQL visible dans phpMyAdmin.

Fichiers principaux :

- `app/Http/Controllers/CampaignController.php`
- `app/Http/Controllers/ContributionController.php`
- `app/Models/Campaign.php`
- `app/Models/Contribution.php`
- `resources/views/campaigns`
- `resources/views/contributions`
- `database/migrations`
- `database/seeders/DemoDataSeeder.php`

Points a expliquer :

- Une campagne appartient a un etudiant avec `belongsTo`.
- Une campagne possede plusieurs contributions avec `hasMany`.
- Une contribution appartient a une campagne.
- La progression d'une campagne est calculee a partir du total des contributions.
- Les listes utilisent la recherche et la pagination.

## Base de donnees

Base utilisee : `crowdfunding_etudiants`

Tables importantes :

- `students`
- `campaigns`
- `contributions`

Export SQL disponible :

- `database/crowdfunding_etudiants.sql`
