FROM php:7.0-apache
MAINTAINER Leandro de Amorim <androri@gmail.com>

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y zip unzip nodejs npm

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

COPY ./ /var/www
COPY ./app/config/parameters_prod.yml /var/www/app/config/parameters.yml
COPY ./.docker/run.sh /var/www/run.sh
COPY ./.docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chmod 775 /var/www/web
RUN chmod -R 777 /var/www/var/cache
RUN chmod -R 777 /var/www/var/logs
RUN chmod -R 777 /var/www/var/sessions

RUN npm install -g gulp && npm install && gulp
RUN composer install -d /var/www


