init project 
```
composer install
cp .env.example .env
php artisan key:generate
php artisan vendor:publish
php artisan vendor:publish --provider="Laravoole\LaravooleServiceProvider"
npm install  --registry=https://registry.npm.taobao.org
npm run dev

```

use php server
```
php artisan serve
```

use swoole server

```
php artisan laravoole [start | stop | reload | reload_task | restart | quit]
```

