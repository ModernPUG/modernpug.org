# modernpug.org

## 설치방법
- `git clone https://github.com/ModernPUG/modernpug.org.git`
- .env.example 을 참고하여 .env 작성 (db, github, log)
- `chmod 777 bootstrap/cache`
- `chmod -R 777 storage`
- `composer install`
- `php artisan vendor:publish`
- `php artisan migrate`

## scss to css
- `npm install`
- `gulp scss.app` or `gulp scss.app:watch`

## 스킨변경
- `php artisan skin:change original`
- `php artisan skin:change redgoose`
