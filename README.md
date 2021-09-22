# laravel-project

## Application start
docker-compose up -d

## Routing list
php artisan route:list

## MySQL
mysql -h 127.0.0.1 -u user -ppassword -D test

## migrate & seed
laravel-app/.env -> DB_HOST=127.0.0.1
php artisan migrate:refresh
php artisan db:seed

# Development

## Make migration
php artisan make:migration create_xxx_table --create=xxx

## Make Controller
php artisan make:controller {Controller}

## Make Model
php artisan make:model Xxx

## Make Request
php artisan make:request {Controller}{Action}Request
