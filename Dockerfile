# Use PHP 8 Apache image
FROM php:8.1-apache

# Copy all project files into container
COPY . /var/www/html/

# Expose port 10000 (Render requirement)
EXPOSE 10000

# Run PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "/var/www/html"]
