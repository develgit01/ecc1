FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install intl

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite
