FROM php:7.4-fpm

#Установим некоторые зависимости и модули PHP
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_mysql zip

# Ставим композер и "хирак ускоритель"
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && composer global require hirak/prestissimo --no-plugins --no-scripts \
    && rm -rf /root/.composer/cache
##Меняем права для некоторых папок
#RUN chown -R $USER:$USER storage

WORKDIR /app
