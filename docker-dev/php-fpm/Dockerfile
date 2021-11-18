FROM debian:buster

ENV DEBIAN_FRONTEND=noninteractive

# Basics
RUN apt-get update && apt-get install -y wget lsb-release

# Install PHP and the rest
# Debian Buster only has php-redis 4.2, we need 4.3
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        ca-certificates \
        curl \
        unzip \
        sudo \
        git \
        php-apcu \
        php-apcu-bc \
        php7.3-cli \
        php7.3-curl \
        php7.3-soap \
        php7.3-json \
        php7.3-mbstring \
        php7.3-opcache \
        php7.3-readline \
        php7.3-xml \
        php7.3-intl \
        php7.3-zip \
        php7.3-redis \
        php7.3-fpm \
        php7.3-ldap \
        php7.3-gmp \
        php7.3-xdebug \
        composer \
        supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

STOPSIGNAL SIGQUIT

ARG UID
RUN useradd -u "${UID:-1000}" -ms /bin/bash user
RUN echo 'user ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Install a newer composer
RUN mkdir -p /home/user/.local/bin
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/bfd95e2a4383ee9cf7c058c2df29d7acb5f86d77/web/installer  -O - -q | php --
RUN mv composer.phar /home/user/.local/bin/composer
ENV PATH "/home/user/.local/bin:${PATH}"

USER user

CMD ["/usr/sbin/php-fpm7.3", "-O" ]
EXPOSE 9000
WORKDIR "/application"