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

### Features
```
- Custom Logging with X-Request-ID
Step 1: Create middleware to append X-Request-ID to headers.
Step 2: Create XRequestIdProcessor to get X-Request-ID from header and add it to Log extra (optional).
Step 3: Create XRequestIdFomatter to formatted X-Request-ID in Log.
Step 4: Custom channels at config/logging.php: use tap to custom config Proccessor, Formatter.

- Handle exception and response

- JWT
- Socialite ?
- Swagger document
- Export with ....
- FE with docker?
```
