FROM php:8.2

WORKDIR /var

COPY . .

RUN apt-get update && \ 
    apt-get install composer && \
    apt-get install php php-pgsql

RUN composer install

EXPOSE 80

CMD ["php", "-S", "localhost:80"]
