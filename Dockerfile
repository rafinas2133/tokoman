FROM php:8.2-fpm AS php_base

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    netcat-openbsd \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:2.8.10 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/tokoman

FROM node:20-alpine AS vite_build
WORKDIR /var/www/tokoman
COPY package*.json ./
RUN npm ci
COPY tailwind.config.js postcss.config.js vite.config.js ./
COPY resources ./resources
RUN npm run build



FROM php_base AS app

WORKDIR /var/www/tokoman

COPY . .

COPY --from=vite_build /var/www/tokoman/public/build ./public/build

RUN composer install --no-scripts --no-dev --prefer-dist --no-interaction

COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

EXPOSE 9000
CMD ["php-fpm"]