FROM php:7.3-apache 
RUN apt-get update -y && apt-get install -y libzip-dev unzip git libpng-dev

# Ajout des extension xxxx.so dans /usr/local/lib/php/extensions/...
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install gd

# Install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.13