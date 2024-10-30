# Use official PHP-FPM image with Alpine
FROM php:8-fpm-alpine
WORKDIR /app/api

ARG UID=1000
ARG GID=1000

ENV UID=${UID}
ENV GID=${GID}

# Create Laravel user and adjust PHP-FPM config
RUN addgroup -g ${GID} laravel && adduser -G laravel -u ${UID} -D laravel \
  && sed -i "s/user = www-data/user = laravel/" /usr/local/etc/php-fpm.d/www.conf \
  && sed -i "s/group = www-data/group = laravel/" /usr/local/etc/php-fpm.d/www.conf

# Install required extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Nginx
RUN apk add nginx && mkdir -p /run/nginx

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Expose both Nginx (80) and PHP-FPM (9000)
EXPOSE 80 9000

# Start services (Nginx + PHP-FPM)
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
