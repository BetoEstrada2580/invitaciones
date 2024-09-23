# Use the official PHP image with PHP 8.1
FROM php:8.1-apache

# Copy the application files into the container
COPY . /var/www/html

# Set the working directory in the container
WORKDIR /var/www/html

# Set correct permissions and list directory
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    ls -al /var/www/html && \
    ls -al /var/www/html/public

# Custom Apache Configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install \
    intl \
    zip \
    && a2enmod rewrite

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev

# Expose port 80
EXPOSE 80

# Define the entry point for the container
CMD ["apache2-foreground"]
