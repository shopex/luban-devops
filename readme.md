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

docker image build

```
docker build --no-cache -t shopex/luban:desktop .
docker run -it -d -p 127.0.0.1:9050:9050 --name mydesktop  -e ETCD_ADDR=192.168.10.96:2379 shopex/luban:desktop
docker exec -it mydesktop bash

```