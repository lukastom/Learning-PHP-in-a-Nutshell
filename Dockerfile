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
RUN apt-get update && apt-get install -y mc \
                                         nano

# create the log directory (for xdebug)
RUN mkdir -p /var/www/log

# Dirty quick unsecure hack here!:
# set permissions for the log directory (for xdebug)
RUN chmod -R 777 /var/www/log

# set permissions for the main directory, so we can create files
RUN chmod -R 777 /var/www/html

# The problem is, in this state, PHP script is run by user www-data but /var/www/html/ is owned by default user 1000 1000 (=nobody). (Let PHP create a new file and see the owner.)
#  This needs a better solution like setting user/group for the folder for this user like this:

# chown www-data:www-data /var/www/html
# chmod 775 /var/www/html
