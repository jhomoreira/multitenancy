FROM php:7.2-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/api/

# Set working directory
WORKDIR /var/www/api

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libpq-dev \
    libfreetype6-dev \
    locales \
    php7.2-zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    php7.2-unzip \
    git \
    php7.2-curl \
    php7.2-gd \
	libzip-dev \
    zip \
	&& docker-php-ext-configure zip --with-libzip \
	&& docker-php-ext-install zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl pgsql pdo pdo_pgsql
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/api

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/api
RUN chown -R www:www /var/www/api

RUN composer install
RUN composer dumpautoload
RUN php artisan migrate

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
