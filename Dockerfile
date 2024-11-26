# Imagen base con PHP 8.1 y Apache
FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y libonig-dev libzip-dev unzip
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite


# Establecer permisos para /var/www/html
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos al contenedor
COPY ./src /var/www/html
