FROM php:7.4-cli

ARG PORT=8000

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        libonig-dev \
        libxml2-dev \
        curl \
        unzip \
        git \
        nano \
        apt-transport-https \
        ca-certificates \
        software-properties-common \
    && docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        mbstring \
        pdo \
        pdo_mysql \
        tokenizer \
        xml \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY ./apithemovieorg ./

RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs

RUN cp .env.example .env \
    && php artisan key:generate

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE $PORT

CMD php artisan serve --host=0.0.0.0 --port=$PORT
