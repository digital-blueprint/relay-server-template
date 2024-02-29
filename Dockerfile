FROM composer:2 AS composer
RUN composer --version

FROM debian:bookworm as build
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
        php-cli \
        php-curl \
        php-gd \
        php-soap \
        php-sqlite3 \
        php-json \
        php-mbstring \
        php-mysql \
        php-opcache \
        php-readline \
        php-xml \
        php-intl \
        php-zip \
        php-redis \
        php-fpm \
        php-ldap \
        php-gmp \
        composer

# copying the source directory and install the dependencies with composer
COPY . /app
WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1

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