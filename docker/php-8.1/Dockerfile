FROM php:8.1-fpm

# Установка пакетов
RUN apt-get update && \
    apt-get install -y \
    software-properties-common \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    pkg-config \
    build-essential \
    libssl-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libmagickwand-dev

RUN docker-php-ext-install pdo_mysql

RUN pecl install xdebug-3.1.0 && \
    docker-php-ext-enable xdebug

COPY docker/php-8.1/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY src /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache

# Открытие портов
EXPOSE 9000

# Запуск пыхи
CMD ["php-fpm"]
