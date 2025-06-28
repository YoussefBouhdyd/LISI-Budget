# Use PHP with FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory in container
WORKDIR /var/www

# Copy app files to container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Create the SQLite database file
RUN mkdir -p /var/www/database && touch /var/www/database/database.sqlite

# Run Laravel setup commands
RUN php artisan config:clear
RUN php artisan migrate --seed

# Set permissions (optional, depending on your setup)
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
