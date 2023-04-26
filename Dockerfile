FROM composer:2 AS composer
RUN composer --version

#FROM php:8.2-cli AS build
#COPY --from=composer /usr/bin/composer /usr/bin/composer

FROM debian:bullseye as build
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV DEBIAN_FRONTEND=noninteractive

# Install PHP and the rest
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        ca-certificates \
        libldap-common \
        git \
        openssh-client \
        php-apcu \
        php-apcu-bc \
        php7.4-cli \
        php7.4-curl \
        php7.4-gd \
        php7.4-soap \
        php7.4-json \
        php7.4-mbstring \
        php7.4-mysql \
        php7.4-opcache \
        php7.4-readline \
        php7.4-xml \
        php7.4-intl \
        php7.4-zip \
        php7.4-redis \
        php7.4-fpm \
        php7.4-ldap \
        php7.4-gmp \
        composer

# copying the source directory and install the dependencies with composer
COPY . /app
WORKDIR /app

# run composer install to install the dependencies
RUN composer install \
  --optimize-autoloader \
  --no-interaction

RUN composer dump-env prod

# continue stage build with the desired image and copy the source including the
# dependencies downloaded by composer
# https://dockerfile.readthedocs.io/en/latest/content/DockerImages/dockerfiles/php-apache.html
FROM webdevops/php-apache:8.2-alpine

# TODO: install missing php extensions
# TODO: set AUTH_SERVER_URL and AUTH_FRONTEND_CLIENT_ID

#USER root
#
## add supervisor config for our own tasks
#COPY docker.prod/supervisord-qon.conf /opt/docker/etc/supervisor.d/supervisord-qon.conf

USER application
COPY --chown=application --from=build /app /app

# create cache dir
RUN mkdir -p /app/var/cache/prod

# change web root
ENV WEB_DOCUMENT_ROOT /app/public