FROM php:8.3.6-fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev zip unzip git curl

# Install ekstensi PHP untuk Laravel
RUN docker-php-ext-install pdo_mysql bcmath gd zip

# Copy Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Set permission agar Laravel bisa menulis log/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache