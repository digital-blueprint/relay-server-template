FROM debian:bullseye

ENV DEBIAN_FRONTEND=noninteractive

# Install PHP and the rest
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        ca-certificates \
        tini \
        libldap-common \
        busybox-static \
        curl \
        unzip \
        sudo \
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
        php7.4-xdebug \
        composer \
        supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Cron setup, run every 5 minutes
RUN mkdir -p /var/spool/cron/crontabs; \
    echo '*/5 * * * * php -f /application/bin/console dbp:relay:core:cron' > /var/spool/cron/crontabs/user
COPY cron.sh /

STOPSIGNAL SIGQUIT

ARG UID
RUN useradd -u "${UID:-1000}" -ms /bin/bash user
RUN echo 'user ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Install a newer composer
RUN mkdir -p /home/user/.local/bin
RUN curl -L https://github.com/composer/getcomposer.org/raw/main/web/download/2.3.7/composer.phar -o /home/user/.local/bin/composer
RUN chmod a+x /home/user/.local/bin/composer
ENV PATH "/home/user/.local/bin:${PATH}"

USER user

CMD ["/usr/sbin/php-fpm7.4", "-O" ]
EXPOSE 9000
WORKDIR "/application"
