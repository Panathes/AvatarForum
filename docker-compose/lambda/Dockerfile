FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

ARG ssh_prv_key
ARG ssh_pub_key

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libgmp3-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gmp
RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip gd sockets gmp

# Get latest Composer
COPY --from=composer:1.10.21 /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

CMD composer install

CMD php ./index.php