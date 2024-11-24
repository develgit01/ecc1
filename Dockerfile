FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libzip-dev

# Instalar extensiones PHP
RUN docker-php-ext-install imagick mysqli

# Copiar tu aplicación
COPY . /var/www/html

# Exponer el puerto
EXPOSE 80

# Comando para iniciar tu aplicación
CMD ["php-fpm"]