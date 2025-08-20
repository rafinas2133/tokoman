FROM php:8.2-fpm AS php_base

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/* # Bersihkan cache apt


RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/tokoman


FROM php_base AS composer_dependencies

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-dev --prefer-dist


FROM node:20-alpine AS vite_build

WORKDIR /var/www/tokoman


COPY package.json package-lock.json vite.config.js tailwind.config.js postcss.config.js ./
COPY resources ./resources

RUN npm install
RUN npm run build



FROM php_base AS app

WORKDIR /var/www/tokoman


COPY . .

COPY --from=composer_dependencies /var/www/tokoman/vendor ./vendor

COPY --from=vite_build /var/www/tokoman/public/build ./public/build


COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh


USER www-data

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php-fpm"]
