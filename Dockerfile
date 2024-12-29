FROM php:7.4-apache

WORKDIR /var/www/html

COPY . /var/www/html

# Install dependencies, including oniguruma and libxml2
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install mbstring xml curl zip json

EXPOSE 80

CMD ["apache2-foreground"]

