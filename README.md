安裝步驟

```bash
composer install
cp .env.example .env
php artisan jwt:secret
php artisan migrate:refresh --seed
```