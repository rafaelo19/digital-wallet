FROM rafaelo19/php7.4-apache:1.0.0

RUN docker-php-ext-install sockets

COPY .docker/php/php.ini /usr/local/etc/php/php.ini

RUN rm -Rf /var/www/* && \
mkdir /var/www/html/

ADD . /var/www/html/

RUN chown -R 1000:1000 /var/www/html
WORKDIR "/var/www/html"

COPY . /var/www/html

RUN chmod 777 -Rf /var/www/html/data /var/www/html/vendor

EXPOSE 80