# Stage 1: Build dependencies
FROM php:8.1-cli-alpine AS builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install

# Stage 2: Final image
FROM php:8.1-apache-fpm-alpine
WORKDIR /var/www/html
COPY --from=builder /app .
COPY apache/apache-config.conf /etc/apache2/sites-available/000-default.conf
EXPOSE 80
CMD ["apache2-foreground"]