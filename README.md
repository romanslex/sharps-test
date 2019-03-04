# Тестовое задание sharps
## Как запустить
- git clone https://github.com/romanslex/sharps-test.git folder
- cd folder
- composer install
- cp .env.example .env
- php artisan key:generate
- (настроть в .env свою бд)
- php artisan migrate --seed
- yarn
- yarn run prod