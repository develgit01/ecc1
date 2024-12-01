# Usar una imagen base de PHP con Apache
FROM php:apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido de la carpeta web al directorio de trabajo
COPY web .

# Configurar el puerto de escucha de Apache
ENV PORT=8000
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copiar un archivo de configuración de Apache personalizado
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto configurado
EXPOSE ${PORT}
