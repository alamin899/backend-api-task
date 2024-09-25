FROM nginx:stable-alpine

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

USER root

ADD ./nginx/default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/html

WORKDIR /var/www/html
