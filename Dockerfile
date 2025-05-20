FROM php:8.2.12-apache

# 必要なツールと PHP 拡張をインストール
RUN apt-get update && apt-get install -y \
  zip unzip git \
  && docker-php-ext-install -j"$(nproc)" opcache pdo pdo_mysql \
  && docker-php-ext-enable opcache

# Apache Rewrite モジュールを有効化
RUN a2enmod rewrite

# ポートとドキュメントルートの変更
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
RUN sed -i 's#/var/www/html#/var/www/html/public#g' /etc/apache2/sites-available/000-default.conf
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Composer を追加
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# アプリケーションのコピーとセットアップ
WORKDIR /var/www/html
COPY . ./

# Laravel セットアップ
RUN composer install --no-dev --optimize-autoloader \
  && php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache \
  && php artisan storage:link

# パーミッション修正
RUN chown -Rf www-data:www-data ./
