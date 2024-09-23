# Use the official PHP image with PHP 8.1
FROM php:8.1-apache

# Copy the application files into the container
COPY . /var/www/html

# Set the working directory in the container
WORKDIR /var/www/html

# Ensure files and directories have correct permissions and enable debugging
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    echo "APP_DEBUG=true" >> /var/www/html/.env && \
    echo "APP_URL=http://localhost" >> /var/www/html/.env

# Custom Apache Configuration pointing to public folder
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

# Copy entrypoint script and make it executable
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

# Define the entry point for the container
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
