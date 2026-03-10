FROM php:8.3-fpm

# Installer extensions nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www

# RUN docker-compose exec php composer create-project laravel/laravel .
# RUN docker-compose exec php php artisan key:generate

WORKDIR /var/www