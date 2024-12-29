# Step 1: Use an official PHP image as a base
FROM php:8.1-fpm

# Step 2: Install dependencies and extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Step 3: Set working directory
WORKDIR /var/www

# Step 4: Install Composer (PHP dependency manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 5: Copy Laravel application files into the container
COPY . .

# Step 6: Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Step 7: Set permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www

# Step 8: Expose port for web server
EXPOSE 9000

# Step 9: Start PHP-FPM
CMD ["php-fpm"]