#php 71 base
FROM shopex/php:php71-pro
MAINTAINER zhangxuehui <zhangxuehui@shopex.cn>

RUN mkdir -p /data/httpd/
COPY . /data/httpd/
WORKDIR /data/httpd/
EXPOSE 9050
CMD ["php", "/data/httpd/artisan", "laravoole" ,"start"]