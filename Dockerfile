FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Copy application code into the container
COPY . /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    && docker-php-ext-install mbstring xml curl zip json

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]

