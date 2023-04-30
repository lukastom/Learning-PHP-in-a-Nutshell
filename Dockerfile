FROM php:8.2-apache

# Install PHP Extensions
RUN docker-php-ext-install mysqli

RUN pecl install xdebug \
	&& docker-php-ext-enable xdebug

# Use the default develompent/production php.ini in /usr/local/etc/php
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
# Note: if in production, also install and enable OPCache.

# Copy my custom php.ini - the particular settings will override main php.ini. The 2 will be merged by PHP. 
COPY ./php.ini /usr/local/etc/php/conf.d/

# Install Midnight Commander, Nano
# RUN apt-get update && apt-get install -y mc \
#                                          nano

# create the log directory (for xdebug)
RUN mkdir -p /var/www/log

# set permissions for the log directory (for xdebug)
RUN chmod -R 777 /var/www/log