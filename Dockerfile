# Usar una imagen base de PHP con Apache
FROM php:8.0-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo composer.json y composer.lock
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install

# Copiar el resto del código fuente
COPY . .

# Exponer el puerto 80 para Apache
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
