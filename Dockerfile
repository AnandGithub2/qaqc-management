FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN touch database/database.sqlite

RUN composer install --no-dev --optimize-autoloader --no-scripts

RUN cp .env.example .env

RUN php artisan key:generate --force

RUN php artisan storage:link || true

RUN chown -R www-data:www-data storage bootstrap/cache database

EXPOSE 8080