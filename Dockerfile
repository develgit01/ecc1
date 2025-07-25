FROM php:8.0-fpm

# Instalar dependencias y Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar directorios
WORKDIR /workspace

# Copiar dependencias de Composer y luego instalar
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist

# Copiar el resto del código
COPY . .

# Copiar configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Asegurar que Nginx escuche en el puerto 8000
EXPOSE 8000

# Script de inicio
CMD service php8.0-fpm start && nginx -g 'daemon off;'
