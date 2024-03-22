FROM nginx:1.23-alpine

# Add www-data
RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

COPY .deploy/local/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --chown=www-data:www-data ./laravel /app

CMD ["nginx", "-g", "daemon off;"]