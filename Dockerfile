FROM php:8.1-apache-buster

RUN apt-get -y update && apt-get -y install zlib1g-dev libzip-dev unzip git gnupg2 libpq-dev
RUN docker-php-ext-install pdo pgsql pdo_pgsql zip sockets
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install sqlsrv driver
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update
RUN ACCEPT_EULA=Y apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev
RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

RUN a2enmod rewrite
RUN a2enmod headers

COPY openssl.cnf /etc/ssl/openssl.cnf

ADD 000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install
RUN composer update
#RUN php artisan octane:install --server=roadrunner
#RUN chmod +x ./rr

EXPOSE 8000

#ENTRYPOINT ["php", "artisan", "octane:start", "--host", "0.0.0.0"]
