FROM php:8.1-apache
WORKDIR /var/www

LABEL maintainer="Daniel Del Cid"

ARG NODE_VERSION=16


RUN apt-get update && apt-get install -y libjpeg-dev libpng-dev libz-dev libfontconfig-dev libtiff-dev && \
    docker-php-ext-install gd; \
    \
    apt-get install -y --no-install-recommends libxml2-dev && \
    docker-php-ext-install soap; \
     \
    apt-get install -y --no-install-recommends libcurlpp-dev && \
    docker-php-ext-install curl; \
    \
    docker-php-ext-install xml; \
    \
    docker-php-ext-install mysqli pdo_mysql;\
    \
    apt-get install -y libzip-dev &&\
    docker-php-ext-install zip;\
    \
    pecl install xdebug && \
    docker-php-ext-enable xdebug; \
    \
    docker-php-ext-install bcmath;\
    \
    apt-get install -y --no-install-recommends libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl; \
    \
    a2enmod rewrite

#RUN  ldap msgpack igbinary redis swoole memcached pcov imapphp8.1-mbstring \

RUN     php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN     curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
        && apt-get install -y nodejs \
        && npm install -g npm \
        && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /usr/share/keyrings/yarn.gpg >/dev/null \
        && echo "deb [signed-by=/usr/share/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
        && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /usr/share/keyrings/pgdg.gpg >/dev/null \
        && echo "deb [signed-by=/usr/share/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt jammy-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
        && apt-get update \
        && apt-get install -y yarn \
        && apt-get -y autoremove \
        && apt-get clean

COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/php.ini /etc/php/8.1/cli/conf.d/99-custom.ini
