# Usar la imagen base de PHP con Apache
FROM php:apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido del directorio web al contenedor
COPY web .

# Copiar el archivo .htaccess al directorio web
# COPY .htaccess .

# Establecer la variable de entorno para el puerto
ENV PORT=8000

# Exponer el puerto configurado
EXPOSE ${PORT}

# Modificar el archivo de configuración de puertos de Apache para escuchar en el puerto configurado
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf

# Habilitar el módulo rewrite de Apache si no está habilitado
RUN a2enmod rewrite

# Reiniciar Apache para aplicar los cambios
RUN service apache2 restart
