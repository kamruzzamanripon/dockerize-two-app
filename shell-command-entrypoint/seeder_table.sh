#!/bin/sh

# Wait for the database to be available
until php artisan migrate:status; do
  echo "Waiting for DB to be ready..."
  sleep 5
done

# Run migrations and seed the database
php artisan migrate --force
php artisan db:seed --force

# Start PHP-FPM and Nginx
php-fpm -D
nginx -g 'daemon off;'
