# Forum Q&R universitaire

Application web de questions-réponses destinée aux étudiants, développée avec **Laravel 12**.
Les utilisateurs publient des questions classées par tags, y répondent, votent pour les réponses utiles
et peuvent se regrouper dans des groupes thématiques disposant de leurs propres questions et d'une messagerie.

> Projet réalisé en équipe dans un cadre académique. Statut : **prototype**.

## Objectifs

- Proposer un espace d'entraide entre étudiants.
- Organiser les échanges par tags et par groupes thématiques.
- Valoriser les contributions grâce aux votes et aux classements.

## Fonctionnalités

| Module | Fonctionnalités |
|---|---|
| Authentification | Inscription (e-mail universitaire, photo de profil facultative), connexion, déconnexion |
| Questions | Fil paginé avec filtres *récentes / populaires / sans réponse*, page de détail, création avec type (`question`, `help`, `discussion`) et tags |
| Tags | Recherche et création en AJAX |
| Réponses | Publication, consultation, modification et suppression depuis l'espace personnel |
| Votes | Ajout ou retrait d'un vote sur une réponse |
| Groupes | Création avec image, adhésion et départ, liste des membres, messagerie, questions internes |
| Profil | Mise à jour des informations et de la photo, historique des questions, réponses et groupes |
| Classements | Utilisateurs, questions, groupes, réponses et tags les plus actifs |
| Recherche | Texte, tags, groupe, auteur, statut de réponse, tri |

## Technologies

- **Back-end :** PHP ≥ 8.2, Laravel 12 (Eloquent, Blade, migrations, seeders)
- **Base de données :** MySQL 8
- **Front-end :** Blade, Bootstrap 5.3 et Bootstrap Icons (CDN), CSS et JavaScript personnalisés (`public/css`, `public/js`)
- **Outillage :** Composer, Docker / Docker Compose, PHPUnit 11 (npm/Vite configurés mais non utilisés par les vues actuelles)

## Organisation du projet

```
app/
├── Http/Controllers/   # Group, Login, Register, Question, Reponse, Tag, Vote, User, UserActivite, Message
├── Http/Middleware/    # Authenticate (redirection vers la page de connexion)
├── Models/             # User, Group, Question, Reponse, Tag, Vote, Message
└── Providers/          # SidebarServiceProvider (données partagées de la barre latérale)
database/
├── migrations/         # Schéma : users, groups, questions, reponses, votes, tags, messages, pivots
└── seeders/            # SampleDataSeeder (données de démonstration)
docker/                 # Script de démarrage du conteneur
resources/views/
├── auth/               # Connexion et inscription
├── layouts/, partials/ # Mise en page, navigation, barres latérales
├── groups/             # Liste et détail des groupes
└── users/              # Questions, réponses, groupes, profil, classements
public/                 # CSS, JS et images statiques
routes/web.php          # Routes publiques et routes protégées (préfixe /user)
tests/                  # Tests PHPUnit
```

### Modèle de données

- `users` 1–N `questions`, `reponses`, `groups` (créateur), `messages`
- `groups` N–N `users` (table `group_user`)
- `questions` N–N `tags` (table `question_tag`)
- `questions` 1–N `reponses` ; `reponses` 1–N `votes` (unicité `user_id` + `reponse_id`)
- `groups` 1–N `questions`, `messages`

## Démarrage rapide avec Docker (recommandé pour tester)

Prérequis : Docker et Docker Compose v2.

```bash
git clone https://github.com/Drak-01/forum.git
cd forum
docker compose up -d --build
```

Au premier démarrage, le conteneur `app` :

1. installe les dépendances Composer ;
2. crée `.env` à partir de `.env.example` s'il n'existe pas, puis génère `APP_KEY` ;
3. exécute les migrations sur le conteneur MySQL ;
4. crée le lien `public/storage` pour les images téléversées.

L'application est ensuite accessible sur **http://localhost:8000** (le premier démarrage peut prendre une minute).

### Commandes utiles

```bash
# Charger les données de démonstration (une seule fois sur une base vide)
docker compose exec app php artisan db:seed

# Réinitialiser la base avec les données de démonstration
docker compose exec app php artisan migrate:fresh --seed

# Lancer les tests
docker compose exec app php artisan test

# Suivre les logs du serveur
docker compose logs -f app

# Arrêter (ajouter -v pour supprimer aussi la base de données)
docker compose down
```

Les comptes de démonstration créés par `SampleDataSeeder` sont définis dans `database/seeders/SampleDataSeeder.php`.

> Le code est monté dans le conteneur : les modifications sont visibles sans reconstruire l'image.
> Les identifiants MySQL de `docker-compose.yml` sont des valeurs de développement, à ne jamais réutiliser en production.
> Sous Linux, si votre UID/GID n'est pas 1000, lancez `HOST_UID=$(id -u) HOST_GID=$(id -g) docker compose up -d --build`.

## Installation sans Docker

Prérequis : PHP 8.2+ (extensions `pdo_mysql`, `zip`), Composer, MySQL.

```bash
composer install
cp .env.example .env        # puis renseigner DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
php artisan migrate
php artisan db:seed         # facultatif
php artisan storage:link
php artisan serve
```

## Configuration (`.env`)

Le fichier `.env.example` sert de modèle. Variables principales :

| Variable | Rôle |
|---|---|
| `APP_KEY` | Clé de chiffrement, générée par `php artisan key:generate` |
| `APP_URL` | URL de l'application (`http://localhost:8000`) |
| `DB_CONNECTION`, `DB_HOST`, `DB_PORT` | Connexion à la base (`mysql`, `127.0.0.1`, `3306`) |
| `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Base et identifiants MySQL |
| `SESSION_DRIVER` | `database` (table `sessions` créée par les migrations) |

Avec Docker, les variables `DB_*` sont fournies par `docker-compose.yml` et prennent le pas sur `.env`.
Ne versionnez jamais votre fichier `.env`.

## Tests

```bash
docker compose exec app php artisan test
```

Les tests utilisent une base SQLite en mémoire (`phpunit.xml`). Seuls les tests d'exemple de Laravel sont présents :
le test unitaire passe, mais le test fonctionnel échoue pour l'instant, car il attend un code 200 sur `/` alors que cette route redirige (302) vers le fil des questions.

## Limites connues

Ce projet est un **prototype pédagogique**, il n'est pas prêt pour la production.

- Certaines actions sont prévues dans les routes mais pas encore implémentées : modification, suppression et invitation dans les groupes, page d'édition du profil.
- Certains parcours (formulaire de création de groupe, détail d'une question de groupe, vote sur une réponse depuis l'interface) doivent encore être corrigés.
- Les contrôles d'autorisation et la limitation des tentatives de connexion restent à généraliser.
- Il n'y a pas encore de couverture de tests.

## Pistes d'amélioration

- Finaliser la gestion des groupes et l'édition du profil.
- Introduire des *Policies* Laravel pour les autorisations.
- Activer la limitation des tentatives de connexion.
- Écrire des tests fonctionnels (authentification, questions, réponses, votes, groupes).
- Ajouter des votes sur les questions et la sélection d'une « meilleure réponse ».
- Ajouter des notifications et une messagerie en temps réel.
- Ajouter des captures d'écran et une démo en ligne.

## Auteurs

Projet réalisé en équipe : *liste des membres et rôles à compléter*.

## Licence

*À définir.*
