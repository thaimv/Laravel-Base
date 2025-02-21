# Laravel base project

### Up docker-compose
```
docker-compose up -d --build
docker compose exec php bash
composer install
cp .env.example .env
php artisan key:generate 
php artisan migrate
php artisan db:seed
```
