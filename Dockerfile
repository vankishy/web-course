# Pakai Apache agar tidak perlu Nginx terpisah
FROM php:8.3-apache

# Install dependencies (Debian style)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libxml2-dev zip unzip libzip-dev \
    && docker-php-ext-install pdo_mysql bcmath gd zip

# Set Document Root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy kodingan
COPY . .

# Install dependencies & set permission
RUN composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Azure butuh port 80
EXPOSE 80

# Pasang tool untuk konversi format file
RUN apt-get update && apt-get install -y dos2unix

# Bersihkan file artisan dan folder-folder penting dari karakter Windows
RUN find . -type f -exec dos2unix {} +

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan Apache di foreground
CMD ["apache2-foreground"]