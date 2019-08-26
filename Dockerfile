FROM node:lts as vue-setup
WORKDIR /app
RUN yarn global add @vue/cli
COPY ./vue ./src/
COPY ./vue/package.json ./
RUN yarn install

# ---

FROM vue-setup as vue-build
##RUN yarn build

FROM php:7.1.20-apache as app
WORKDIR /var/www/app

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

# Install important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip

# Other PHP7 Extensions
RUN apt-get -y install libmcrypt-dev mysql-client zlib1g-dev libicu-dev
RUN docker-php-ext-install mcrypt curl tokenizer json zip intl mbstring
RUN pecl install mongodb

# Enable apache modules
RUN a2enmod rewrite headers

# Copy source files and config files to image.
COPY ./app/ .
COPY ./config/ /

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader

# ---

FROM app as development
# Install Xdebug
RUN apt-get install -y nano && pecl install xdebug-2.5.0
RUN docker-php-ext-enable xdebug

# ---

FROM app as production
COPY --from=vue-build /app/dist/ ./public/
