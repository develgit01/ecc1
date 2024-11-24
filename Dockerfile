FROM php:8.1-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    php8.2-intl \
    libapache2-mod-php8.2 \
    # Agrega aquí cualquier otra extensión necesaria
    
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite
