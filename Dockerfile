FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git

## mysql
RUN docker-php-ext-install pdo pdo_mysql mysqli

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./conf/php/docker-php-entrypoint /usr/local/bin/
RUN chmod 755 /usr/local/bin/docker-php-entrypoint
