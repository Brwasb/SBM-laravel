#!/bin/bash

# Clone the repository
git clone https://github.com/Brwasb/SBM-laravel.git
cd SBM-laravel

# Install Composer dependencies
composer install --no-interaction --prefer-dist --no-dev

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Set up storage permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Run migrations (optional - you might want to let users do this manually)
# php artisan migrate

echo "Installation complete! Please configure your .env file and run 'php artisan serve'"