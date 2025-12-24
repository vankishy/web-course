FROM php:8.3-fpm-alpine

ARG WWWUSER=1000
ARG WWWGROUP=1000

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    icu-dev \
    sqlite-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    autoconf \
    g++ \
    make \
    linux-headers

RUN docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql bcmath gd exif intl opcache pcntl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN set -eux; \
    addgroup -g ${WWWGROUP} sail; \
    adduser -u ${WWWUSER} -G sail -D -h /home/sail sail

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader --no-dev

COPY . .

RUN composer dump-autoload --optimize && \
    chown -R sail:sail /var/www/html

USER sail

EXPOSE 9000

CMD ["php-fpm"]