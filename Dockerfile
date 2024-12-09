FROM php:8.2

COPY . .

WORKDIR /var

RUN apt-get update && \ 
    apt-get install composer && \
    apt-get install php-pgsql

RUN composer install

EXPOSE 80

CMD ["php", "-S", "localhost:80"]