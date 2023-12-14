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
        libpq-dev

# Installer PHP 7.4
RUN apt-get update && \
    apt-get install -y \
        php7.4 \
        php7.4-mysql \
        php7.4-cli \
        php7.4-fpm \
        php7.4-intl \
        php7.4-mbstring \
        php7.4-xml \
        php7.4-zip \
        php7.4-pgsql \
        php7.4-gd \
        php7.4-curl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer un répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet Symfony dans le conteneur
# COPY . .

# Installer les dépendances du projet Symfony
# RUN composer install --no-scripts --no-interaction

# Exposer le port 8000 (ou tout autre port que vous utilisez pour Symfony)
EXPOSE 8000

# Commande par défaut pour démarrer le serveur Symfony
#CMD ["php", "bin/console", "server:run", "0.0.0.0:8000"]

CMD php -S 0.0.0.0:8000