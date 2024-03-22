FROM nginx:1.23-alpine
ARG CONFIG_FILE
COPY ./$CONFIG_FILE /etc/nginx/templates/default.conf.template
COPY ./global/server.conf /etc/nginx/conf.d/server.conf
