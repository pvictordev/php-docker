# Use an official PHP runtime as a parent image
FROM php:8.2-cli

# Set the working directory to /app
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Copy the current directory contents into the container at /app
COPY . /app

# Install PHP dependencies with Composer plugins enabled for superuser
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Make port 8000 available to the world outside this container
EXPOSE 8000

# Run index.php when the container launches
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]
