#!/bin/bash

echo "🚀 Starting Deployment..."

# Install dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --class=AdminSeeder --force

# Create storage link
php artisan storage:link || echo "Storage link already exists"

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment Finished!"
