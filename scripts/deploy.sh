set -x
set -e
echo "Deploying the application"
git pull
composer install
npm install
git restore package-lock.json
npm update
npm run build
php artisan migrate --force