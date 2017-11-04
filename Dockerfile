FROM php:7.0-apache
MAINTAINER Leandro de Amorim <androri@gmail.com>

RUN docker-php-ext-install pdo pdo_mysql

# RUN curl -sS https://getcomposer.org/installer | php \
#     && mv composer.phar /usr/local/bin/ \
#     && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN rm -rf /var/www/html

COPY ./project/ /var/www

RUN chmod 775 /var/www/html

#RUN ln -s /var/cache /var/www/var/cache

# RUN composer install -d /var/www --no-plugins --no-scripts
