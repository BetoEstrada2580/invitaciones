#!/bin/bash

set -e

# Set permissions and ensure environment
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate APP_KEY if not present
if ! grep -q "APP_KEY=" /var/www/html/.env; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Start Apache
echo "Starting Apache..."
apache2-foreground
