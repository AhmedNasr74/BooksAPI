FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COMPOSER_MEMORY_LIMIT=-1 composer install