FROM node:16-slim as node-builder

COPY . ./app
RUN cd /app && npm ci && npm run prod

FROM php:8.2.12-apache

RUN apt-get update && apt-get install -y \
  zip unzip git \
  && docker-php-ext-install -j"$(nproc)" opcache pdo pdo_mysql \
  && docker-php-ext-enable opcache

RUN a2enmod rewrite

RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . ./
COPY --from=node-builder /app/public ./public
RUN composer install --no-dev --optimize-autoloader
RUN chown -Rf www-data:www-data ./
