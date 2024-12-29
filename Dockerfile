
FROM php:7.4-apache
WORKDIR /var/www/html
COPY . /var/www/html
RUN docker-php-ext-install mbstring xml curl zip json
EXPOSE 80
CMD ["apache2-foreground"]
