FROM rafaelo19/php:7.4

COPY .docker/php/php.ini /usr/local/etc/php/

COPY . /var/www/html

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php

RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get update \
    && apt-get install -y libpq5 libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get autoremove --purge -y libpq-dev \
    && apt-get clean ;

RUN chmod 777 -Rf /var/www/html/data /var/www/html/vendor
