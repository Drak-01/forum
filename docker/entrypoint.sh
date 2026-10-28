#!/bin/sh
set -e

# Dépendances (le dossier vendor est un volume nommé)
composer install --no-interaction --prefer-dist

# Fichier .env et clé d'application
[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=base64:' .env || php artisan key:generate --force

php artisan migrate --force
[ -e public/storage ] || php artisan storage:link

exec "$@"
