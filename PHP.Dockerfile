FROM php:8.0-fpm
COPY . /.
WORKDIR /.

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer update