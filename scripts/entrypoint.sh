#!/bin/bash
set -e

# Run Laravel optimizations and migration on container startup
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Start Apache web server
exec apache2-foreground
