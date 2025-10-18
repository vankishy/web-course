# Start from the base PHP-FPM image with Alpine (ringan)
FROM php:8.3-fpm-alpine

# Setel argumen dan variabel lingkungan
ARG WWWGROUP=1000
ARG WWWUSER=1000
ARG XDEBUG_VERSION

# Instal dependensi sistem yang dibutuhkan
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

# Hapus dependensi yang tidak diperlukan
RUN docker-php-ext-install pdo_mysql opcache \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip

# Instal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Tambahkan grup dan user 'sail' (mengatasi error 'groupadd')
RUN set -eux; \
    addgroup -g ${WWWGROUP} -S sail; \
    adduser -G sail -u ${WWWUSER} -D sail; \
    mkdir -p /home/sail/.composer; \
    chown -R sail:sail /home/sail

# Pindah ke direktori aplikasi
WORKDIR /var/www/html

# Ganti user ke 'sail'
USER sail