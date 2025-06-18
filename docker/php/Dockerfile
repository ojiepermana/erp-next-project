FROM php:8.4-fpm

RUN apt-get update && apt-get install -y  zip unzip curl git libpq-dev libpng-dev libjpeg-dev libonig-dev libxml2-dev     && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd mbstring xml

WORKDIR /var/www
