FROM php:8.3-apache 
 
# Extensión para MySQL y módulos de Apache 
RUN docker-php-ext-install pdo_mysql \ 
 && a2enmod rewrite headers \ 
 && echo 'ServerTokens Prod' >> /etc/apache2/apache2.conf \ 
 && echo 'ServerSignature Off' >> /etc/apache2/apache2.conf 
 
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf 
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer 
 
WORKDIR /var/www/html 
COPY composer.json composer.lock ./ 
RUN composer install --no-dev --no-interaction --no-autoloader 
 
COPY . . 
RUN composer dump-autoload --optimize \ 
 && chown -R www-data:www-data /var/www/html 
 
EXPOSE 80 