#!/bin/sh
set -e

cd /var/www/html

echo "[entrypoint] Preparing Laravel runtime directories..."

mkdir -p storage/app/public \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/testing \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

chmod -R 775 storage bootstrap/cache || true

if [ ! -f "vendor/autoload.php" ]; then
  echo "[entrypoint] vendor/autoload.php is missing."
  echo "[entrypoint] Run setup with:"
  echo "[entrypoint] docker compose exec --user root laravel sh docker/setup.sh"
  exec php-fpm
fi

echo "[entrypoint] Fixing Laravel writable directory permissions..."

chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

if [ -f "artisan" ] && [ ! -L "public/storage" ]; then
  echo "[entrypoint] Creating storage link if missing..."
  php artisan storage:link || true
fi

echo "[entrypoint] Starting cron and PHP-FPM..."

cron -f & exec php-fpm
