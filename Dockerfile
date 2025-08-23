# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones comunes de PHP (opcional)
RUN docker-php-ext-install pdo pdo_mysql

# Copia los archivos de la aplicación al directorio del servidor web
COPY src/ /var/www/html/

# Expone el puerto 80
EXPOSE 80

# Inicia el servidor Apache en primer plano
CMD ["apache2-foreground"]
