FROM php:8.1-fpm-alpine
ARG USER

WORKDIR /app

#install packages
RUN apk update && apk add \
    build-base \
    vim \
    bash \
    curl \
    supervisor

# Install extensions
RUN curl -sSLf \
            -o /usr/local/bin/install-php-extensions \
            https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions \
            pdo \
            pdo_pgsql \
            gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip && docker-php-ext-install zip

COPY ./.deploy/local/php.ini /usr/local/etc/php/conf.d/40-custom.ini
COPY ./.deploy/local/supervisor/supervisor.ini /etc/supervisor.d/supervisor.ini

RUN rm -rf /var/cache/apk/* && docker-php-source delete

COPY --chown=www-data:www-data ./laravel /app

EXPOSE 9000