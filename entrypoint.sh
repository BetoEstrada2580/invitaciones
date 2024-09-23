#!/bin/bash

# Ensure permissions are set
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ensure environment is configured
if ! grep -q "APP_KEY=" /var/www/html/.env; then
    echo "Generating APP_KEY..."
    php artisan key:generate
fi

# Start Apache service
apache2-foreground
