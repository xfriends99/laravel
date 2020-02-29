FROM php:7.2-fpm-alpine

# Install PHP extensions
RUN apk update && apk add libxml2-dev libmcrypt vim zip unzip git wget vim nano curl openssh sshpass \
    && docker-php-ext-install json mbstring xml soap zip bcmath

# Install Postgres extension
RUN set -ex && apk --no-cache add postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www