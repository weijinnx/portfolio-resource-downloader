FROM php:fpm

LABEL maintainer="Vladyslav Prykhodko <vuishnak@gmail.com>"

WORKDIR /var/www

# Borrowed from Laradock
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    nginx \
    curl \
    git \
    xz-utils \
    libzip-dev \
    libpcre3-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libxml2-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip

RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

# Do a composer install without any of the application files so we can change code without requiring a reinstall
COPY composer.json composer.lock /var/www/
RUN composer install --no-autoloader --no-scripts

# Copy application code
COPY . /var/www/

# PHP Conf files
COPY ./docker/etc /usr/local/etc/php/conf.d/

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo UTC > /etc/timezone
# Setup the application folders so everything has the right permissions. Run composer scripts
RUN composer dumpautoload -o && \
    mkdir -p /var/log/nginx && \
    touch /var/log/nginx/surgead.log && \
    usermod -u 1000 www-data && \
    mkdir -p /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/app && \
    chown -R www-data /var/www/storage/* /var/www/storage /var/log/nginx/*

# The port NGINX is expecting
EXPOSE 9000