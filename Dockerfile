# Imagen base con PHP 8.1 y Apache
FROM php:8.1-apache

# Actualización del sistema e instalación de dependencias necesarias para PHP
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar archivo php.ini personalizado (si es necesario)
# Puedes descomentar y configurar un php.ini si lo necesitas.
# COPY php.ini /usr/local/etc/php/

# Configurar el directorio de trabajo
WORKDIR /var/www/html
