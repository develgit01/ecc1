
FROM php:8.2-apache

RUN apt-get update && apt-get install -y php-imagick php-mysqli

# Copy your application code
COPY api /var/www/html

# Run your application (optional)
CMD ["apache2-foreground"]
# Verificar si se debe reiniciar
ENV SHOULD_RESTART=false

# Script para reiniciar httpd si es necesario
COPY restart.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/restart.sh

CMD ["sh", "-c", "if [ \"$SHOULD_RESTART\" = \"true\" ]; then /usr/local/bin/restart.sh; fi && apache2-foreground"]