FROM nginx:1.23-alpine

# Add www-data
RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

COPY .deploy/prod/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --chown=www-data:www-data ./laravel /app
RUN ln -s /app/storage/app/avatars        /app/public/api && \
    ln -s /app/storage/app/achievements   /app/public/api && \
    ln -s /app/storage/app/logos          /app/public/api && \
    ln -s /app/storage/app/attachments    /app/public/api

CMD ["nginx", "-g", "daemon off;"]
