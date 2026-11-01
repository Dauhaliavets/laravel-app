FROM php:8.4-fpm-alpine

# Системные зависимости
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    $PHPIZE_DEPS

# Расширения PHP (аналоги установки пакетов, но на уровне C-расширений)
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    intl \
    opcache \
    bcmath

# Composer (глобально, как npm)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Устанавливаем зависимости для сборки, собираем Xdebug и очищаем кэш
RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug-3.4.0 \
    && docker-php-ext-enable xdebug \
    && apk del $PHPIZE_DEPS linux-headers

WORKDIR /var/www/html