FROM php:8.1.12-apache
RUN apt-get update && apt-get install -y \
    git \
    libmcrypt-dev \
    libzip-dev \
    zip \
    libc-client-dev \
    libkrb5-dev \
    libonig-dev \
  && rm -r /var/lib/apt/lists/* \
  && pecl install mcrypt \
  && docker-php-ext-enable mcrypt \
  && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
  && docker-php-ext-install imap mbstring zip

