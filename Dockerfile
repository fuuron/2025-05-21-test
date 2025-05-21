# PHP 8.2 をベースとした公式イメージ（Apache付き）
FROM php:8.2.12-apache

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl gd

# Composerのインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ApacheのドキュメントルートをLaravelのpublicディレクトリに設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apacheの設定を変更
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}/../!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# mod_rewrite 有効化
RUN a2enmod rewrite

# Laravel アプリケーションのコピー
COPY . /var/www/html

# パーミッション設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Composer install（本番用依存のみ）
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# ポート 80 を公開
EXPOSE 80

# Laravel アプリケーション起動
CMD ["apache2-foreground"]
