# Web Base Stage
FROM nginx:mainline AS web-base

# SHELL
SHELL ["/bin/bash", "-c"]

# Copy the Nginx configuration file
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf


# Web development Stage
FROM web-base AS web-dev

# Port to expose
EXPOSE 80

# Copy to development configuration file
COPY ./nginx/conf/dev.conf /etc/nginx/conf/dev.conf


# Web production Stage
FROM web-base AS web-prod

# Port to expose
EXPOSE 443

# Copy to production configuration file
COPY ./nginx/conf/prod.conf /etc/nginx/conf/prod.conf

# Copy the SSL certificate
COPY ./nginx/ssl /etc/nginx/ssl



# App base Stage
FROM php:8.3.8-fpm AS app-base

# SHELL
SHELL ["/bin/bash", "-c"]

# Port to expose
EXPOSE 9000

# Install depends
RUN apt-get update && apt-get install -y git zip unzip libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer(Use Multi-stage_build)
COPY --from=composer:lts /usr/bin/composer /usr/bin/composer


# App development Stage
FROM app-base AS app-dev

# Set development environment
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_PROCESS_TIMEOUT=4096

# Copy to development configuration file
COPY ./php/dev.ini /usr/local/etc/php/php.ini

# Set working directory
WORKDIR /var/app

# Copy to composer.json and composer.lock
COPY ./php/composer/composer.json ./composer.json
COPY ./php/composer/composer.lock ./composer.lock

# Copy to composer install recommends file
COPY ./php/laravel/ ./

# Composer install
RUN composer install


# db base Stage
FROM mysql:lts AS db-base

# SHELL
SHELL ["/bin/bash", "-c"]

# Port to expose
EXPOSE 3306

# Copy to mysql configuration file
COPY ./mysql/my.cnf /etc/mysql/my.cnf

# Set Common Environment
ENV TZ=Asia/Tokyo
ENV MYSQL_DATABASE=Seicheese


# db development Stage
FROM db-base AS db-dev

# Set development environment
ENV MYSQL_ROOT_PASSWORD=root_password


# db production Stage
FROM db-base AS db-prod

# Set production environment
ENV MYSQL_ROOT_PASSWORD=
ENV MYSQL_USER=
ENV MYSQL_PASSWORD=



# admin stage
FROM phpmyadmin:5.2.1 AS admin

# SHELL
SHELL ["/bin/bash", "-c"]

# Set Environment
ENV PMA_HOST=back-db
ENV PMA_USER=root
ENV PMA_PASSWORD=root_password