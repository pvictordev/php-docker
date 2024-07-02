# Use an official PHP runtime as a parent image
FROM php:8.2-cli

# Set the working directory in the container
WORKDIR /var/www/html

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the current directory contents into the container at /var/www/html
COPY . .

# Make port 8000 available to the world outside this container
EXPOSE 8000

# Run index.php when the container launches
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
