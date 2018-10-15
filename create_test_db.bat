php artisan migrate:refresh --env=testing
php artisan db:seed --env=testing
php artisan db:seed --class TestCaseSeeder --env=testing
