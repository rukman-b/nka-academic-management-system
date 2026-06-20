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

echo "[setup] Setting Laravel runtime directory permissions..."

find storage bootstrap/cache -type d -exec chmod 775 {} \;
find storage bootstrap/cache -type f -exec chmod 664 {} \;

echo "[setup] Marking mounted Git repository as safe for container setup..."

git config --global --add safe.directory /var/www/html || true

echo "[setup] Installing Composer dependencies..."

COMPOSER_CACHE_DIR=/tmp/composer-cache composer install

echo "[setup] Preparing testing database..."

php -r "
\$host = getenv('DB_HOST') ?: 'db';
\$port = getenv('DB_PORT') ?: '3306';
\$rootPass = getenv('DB_ROOT_PASSWORD') ?: 'secret';
\$testDb = getenv('DB_TEST_DATABASE') ?: 'nka_hub_testing';
\$appUser = getenv('DB_USERNAME') ?: 'nka_user';
\$appPass = getenv('DB_PASSWORD') ?: 'secret';

\$pdo = new PDO(\"mysql:host=\$host;port=\$port\", 'root', \$rootPass);
\$pdo->exec(\"CREATE DATABASE IF NOT EXISTS \`\$testDb\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci\");
\$pdo->exec(\"GRANT ALL PRIVILEGES ON \`\$testDb\`.* TO '\$appUser'@'%' IDENTIFIED BY '\$appPass'\");
\$pdo->exec('FLUSH PRIVILEGES');
"

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

echo "[setup] Re-applying safe runtime permissions..."

find storage bootstrap/cache -type d -exec chmod 775 {} \;
find storage bootstrap/cache -type f -exec chmod 664 {} \;

echo "[setup] Setup completed successfully."