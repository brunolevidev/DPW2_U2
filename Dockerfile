# syntax=docker/dockerfile:1
FROM node:lts-alpine AS frontend
WORKDIR /usr/src/dpw2_u2_brvs
COPY package.json ./
COPY package-lock.json ./
COPY app ./app
RUN npm install
COPY webpack.config.js ./
RUN npm run build

FROM composer:latest AS vendor
WORKDIR /usr/src/dpw2_u2_brvs
COPY --from=frontend /usr/src/dpw2_u2_brvs/ ./
COPY composer.json ./
COPY composer.lock ./
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

FROM php:8.1-apache
COPY --from=vendor /usr/src/dpw2_u2_brvs /var/www/html
COPY .env /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html/app
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo_mysql