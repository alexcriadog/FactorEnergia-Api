FROM php:8.1-apache

WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=80
