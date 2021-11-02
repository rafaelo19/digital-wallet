FROM rafaelo19/php:7.4

COPY .docker/php/php.ini /usr/local/etc/php/

COPY . /var/www/html

RUN chmod 777 -Rf /var/www/html/data /var/www/html/vendor
