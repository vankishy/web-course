FROM php:8.3-fpm-alpine

ARG WWWGROUP=1000
ARG WWWUSER=1000
ARG XDEBUG_VERSION

RUN apk add --no-cache \
    git \
    curl \
    libxml2-dev \
    libpng-dev \
    libzip-dev \
    icu-dev \
    sqlite-dev \
    libjpeg-turbo-dev \
    autoconf \
    g++ \
    make

RUN docker-php-ext-install pdo_mysql opcache \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN set -eux; \
    addgroup -g ${WWWGROUP} -S sail; \
    adduser -G sail -u ${WWWUSER} -D sail; \
    mkdir -p /home/sail/.composer; \
    chown -R sail:sail /home/sail

WORKDIR /var/www/html

USER sail