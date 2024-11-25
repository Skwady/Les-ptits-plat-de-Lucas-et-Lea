# Utiliser une image PHP avec Apache
FROM php:8.3.13-apache

# Mise à jour du système et installation des extensions nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libxslt-dev \
    libzip-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        intl \
        gd \
        opcache \
        exif \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer l'extension MongoDB PHP
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Activer le module mod_rewrite d'Apache
RUN a2enmod rewrite

# Configurer Apache pour pointer vers le dossier public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Définir les fichiers par défaut recherchés par Apache
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Définir le ServerName pour Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copier le fichier php.ini personnalisé
COPY config/php.ini /usr/local/etc/php/php.ini

# Copier tout le projet dans le conteneur
COPY . /var/www/html

# Changer les permissions des fichiers pour Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances du projet avec Composer
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80 pour Apache
EXPOSE 80

# Lancer Apache en premier plan
CMD ["apache2-foreground"]