FROM php:7.4-apache

WORKDIR /var/www/html

COPY . /var/www/html

# Update apt and install required dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install mbstring xml curl zip json \
    && apt-get clean

# Expose the application port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

