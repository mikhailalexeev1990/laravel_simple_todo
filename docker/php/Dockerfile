# PHP
FROM php:8.1.0-fpm-alpine AS php
WORKDIR /var/www/app
RUN set -eux \
    && apk add --no-cache --virtual .pgsql-deps postgresql-dev \
    && docker-php-ext-install -j$(nproc) pcntl pdo_pgsql \
    && apk add --no-cache --virtual .pgsql-rundeps so:libpq.so.5 \
    && apk del .pgsql-deps

ENTRYPOINT ["/bin/sh", "-c"]
CMD ["php-fpm"]


# COMPOSER
FROM composer:latest AS composer


# STAGE APP
FROM php AS app
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN set -eux \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \
    && { \
        echo "zend_extension=xdebug.so"; \
        echo "xdebug.idekey=laravel_simple_todo"; \
        echo "xdebug.discover_client_host=0"; \
        echo "xdebug.mode=debug"; \
        echo "xdebug.start_with_request=yes"; \
        echo "xdebug.client_host=host.docker.internal"; \
        echo "xdebug.log_level=0"; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
