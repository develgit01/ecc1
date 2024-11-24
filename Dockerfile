FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Install the necessary libraries
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install \
    mbstring \
    zip
RUN docker-php-ext-install imagick mysqli

# Copy over the Laravel project
COPY . .

# Install Composer along with the dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Copy over the .env file and generate the app key
COPY .env .env
RUN php artisan key:generate

# Expose port 80
EXPOSE 80

# Adjusting Apache configurations
RUN a2enmod rewrite
COPY apache/apache-config.conf /etc/apache2/sites-available/000-default.conf


# Comando para iniciar tu aplicación
CMD ["php-fpm"]

