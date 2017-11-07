FROM php:7.0-apache

MAINTAINER Leandro de Amorim <androri@gmail.com>

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y zip unzip npm

RUN npm cache clean -f
RUN npm install -g n
RUN n stable
RUN node --version

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer
RUN composer

COPY ./ /var/www
COPY ./app/config/parameters_prod.yml /var/www/app/config/parameters.yml

RUN sed -i 's!/var/www/html!/var/www/web!g' /etc/apache2/apache2.conf
RUN sed -i 's!/var/www/html!/var/www/web!g' /etc/apache2/sites-available/000-default.conf

RUN chmod 775 /var/www/web
RUN chmod -R 777 /var/www/var/logs
RUN chmod -R 777 /var/www/var/sessions

RUN npm install
RUN npm install -g gulp
RUN composer install -d /var/www
RUN gulp


