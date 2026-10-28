FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Utilisateur non-root aligné sur l'UID/GID de l'hôte (fichiers du volume monté)
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} app && useradd -u ${UID} -g app -m app

WORKDIR /var/www/html

COPY --chown=app:app . .
COPY --chmod=755 docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh

USER app

RUN composer install --no-interaction --prefer-dist --no-scripts \
    && composer dump-autoload --optimize

EXPOSE 8000

ENTRYPOINT ["docker-entrypoint.sh"]
# Serveur PHP intégré lancé directement : `artisan serve` filtre les variables
# d'environnement (DB_HOST, etc.) transmises par docker compose.
CMD ["sh", "-c", "cd public && exec php -S 0.0.0.0:8000 ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php"]
