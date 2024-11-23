FROM php:8.2-apache

RUN apt-get update && apt-get install -y php-imagick php-mysqli

# Copy your application code
COPY api /var/www/html

# Run your application (optional)
CMD ["apache2-foreground"]