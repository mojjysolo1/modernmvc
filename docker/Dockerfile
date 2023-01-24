FROM php:8.2.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install opcache

WORKDIR /var/www