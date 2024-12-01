# Usar una imagen base de PHP con Nginx
FROM php:8.0-fpm

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /workspace

# Copiar el archivo composer.json y composer.lock
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install

# Copiar el resto del código fuente
COPY . .

# Copiar el archivo de configuración de Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando para iniciar PHP-FPM
CMD ["php-fpm"]
