FROM debian:bookworm

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
        php-xdebug \
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
RUN curl -L https://github.com/composer/getcomposer.org/raw/main/web/download/2.7.1/composer.phar -o /home/user/.local/bin/composer
RUN chmod a+x /home/user/.local/bin/composer
ENV PATH "/home/user/.local/bin:${PATH}"

USER user

CMD ["/usr/sbin/php-fpm8.2", "-O" ]
EXPOSE 9000
WORKDIR "/application"
