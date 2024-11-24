FROM ubuntu:22.04

# Instalar paquetes adicionales (si es necesario)
RUN apt-get update && apt-get install -y \
    build-essential \
    libssl-dev \
    libffi-dev \
    libgdbm-dev \
    libncurses5-dev \
    libreadline-dev \
    libz-dev \
    libbz2-dev \
    locales

# Configurar la localización
ENV LANG C.UTF-8
ENV LANGUAGE C.UTF-8
ENV LC_ALL C.UTF-8


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