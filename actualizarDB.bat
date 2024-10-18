call copy .env.example .env
call php artisan key:generate
call php artisan migrate