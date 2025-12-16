FROM php:8.3-apache-bookworm as app-local

ENV APP_ENV=local
ENV APP_DEBUG=true

RUN apt-get update && apt-get install -y \
    zlib1g-dev zip \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpng-dev \
    supervisor \
    default-mysql-client \
    nodejs npm \
    jpegoptim optipng pngquant gifsicle \
    libzip-dev libonig-dev \
    freetds-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

    
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install bcmath sockets pdo pdo_mysql zip

RUN docker-php-ext-install pdo_dblib

RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl

RUN docker-php-ext-configure opcache --enable-opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require laravel/installer

ENV PATH="/root/.config/composer/vendor/bin:$PATH"

RUN echo "alias lnew='/root/.config/composer/vendor/bin/laravel new'" >> /root/.bashrc

WORKDIR /var/www/html

COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN npm install -g @angular/cli

RUN a2enmod rewrite

CMD ["apache2-foreground"]