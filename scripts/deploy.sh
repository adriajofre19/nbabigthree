set -x
set -e
echo "Deploying the application"
git restore package-lock.json
git pull
composer install
npm install
npm update
npm run build
php artisan migrate --force