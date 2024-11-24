FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    mysql-server \
    && docker-php-ext-install intl

# Configurar MySQL
RUN service mysql start && \
    mysql -u root -e "CREATE DATABASE mydatabase;" && \
    mysql -u root -e "CREATE USER 'myuser'@'localhost' IDENTIFIED BY 'mypassword';" && \
    mysql -u root -e "GRANT ALL PRIVILEGES ON mydatabase.* TO 'myuser'@'localhost';" && \
    mysql -u root -e "FLUSH PRIVILEGES;"

# Copiar el código de la aplicación al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Cambiar permisos y habilitar mod_rewrite
RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

# Comando para ejecutar Apache
CMD ["apache2-foreground"]
