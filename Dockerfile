# Imagen base con PHP 8.1 y Apache
FROM php:8.1-apache

# Actualización del sistema e instalación de extensiones necesarias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Configuración de permisos para Apache
RUN echo '<Directory "/var/www/html">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>' > /etc/apache2/conf-available/permissions.conf && \
    a2enconf permissions

# Cambiar permisos de los archivos
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación al contenedor
COPY ./src /var/www/html
