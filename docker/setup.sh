#!/bin/sh
set -e

cd /var/www/html

echo "[setup] Creating required Laravel runtime directories..."

mkdir -p storage/app/public \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/testing \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

chmod -R 775 storage bootstrap/cache

echo "[setup] Installing Composer dependencies..."

COMPOSER_CACHE_DIR=/tmp/composer-cache composer install

echo "[setup] Generating Laravel application key..."

php artisan key:generate --force

echo "[setup] Running database migrations..."

php artisan migrate --force

echo "[setup] Running database seeders..."

php artisan db:seed --force

echo "[setup] Creating Laravel storage link..."

php artisan storage:link || true

echo "[setup] Fixing Laravel writable directory ownership..."

chown -R www-data:www-data storage bootstrap/cache vendor
find storage bootstrap/cache -type d -exec chmod 775 {} \;
find storage bootstrap/cache -type f -exec chmod 664 {} \;

echo "[setup] Setup completed successfully."
