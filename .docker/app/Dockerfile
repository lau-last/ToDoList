# Utiliser l'image officielle Debian
FROM debian:bullseye-slim

# Mettre à jour les paquets et installer les dépendances nécessaires
RUN apt-get update && \
    apt-get install -y \
        curl \
        wget \
        git \
        unzip \
        libzip-dev \
        libicu-dev \
        libonig-dev \
        libpng-dev \
        libxml2-dev \
        libpq-dev \
        nano

RUN apt-get install -y lsb-release apt-transport-https ca-certificates
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'

RUN apt-get update && apt-get install -y curl sudo \
    && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash

# Installer PHP 8.3
RUN apt-get update && \
    apt-get install -y \
        symfony-cli \
        php8.3 \
        php8.3-pdo \
        php8.3-mysql \
        php8.3-apcu \
        php8.3-xdebug \
        php8.3-cli \
        php8.3-fpm \
        php8.3-intl \
        php8.3-mbstring \
        php8.3-xml \
        php8.3-zip \
        php8.3-pgsql \
        php8.3-gd \
        php8.3-curl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer un répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet Symfony dans le conteneur
# COPY . .

# Copier le php.ini
# COPY php.ini /etc/php/8.3/fpm/php.ini

# Installer les dépendances du projet Symfony
# RUN composer install --no-scripts --no-interaction

# Exposer le port 8000 (ou tout autre port que vous utilisez pour Symfony)
EXPOSE 8000

# Commande par défaut pour démarrer le serveur Symfony
# CMD ["php", "bin/console", "server:run", "0.0.0.0:8000"]

# CMD php -S 0.0.0.0:8000 -t public
CMD symfony server:start