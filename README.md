# GiftShare (Laravel 12 + Livewire)

## Setup
1. Clone repo
2. `composer install`
3. `cp .env.example .env` and edit DB settings (MariaDB)
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan storage:link`
7. `npm install && npm run dev`
8. `php artisan serve`

Default test user: `tester@example.com` / `password`

## Notes
- Laravel 12, Livewire used for dynamic interactions.
- DB: MariaDB
- Photos stored in `storage/app/public/items`

