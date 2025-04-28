FROM php:8.2-fpm

RUN useradd -m -u 1000 1000

RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo_mysql sockets pcntl

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

USER 1000

CMD php artisan serve --host=0.0.0.0 --port=8000
