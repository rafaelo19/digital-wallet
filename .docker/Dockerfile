FROM php:8.5-apache

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && a2enmod rewrite \
    && printf "ServerName localhost\n" > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY .docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY . /var/www/html

RUN mkdir -p /var/www/html/data /var/www/html/logs/apache2 \
    && chown -R www-data:www-data /var/www/html
