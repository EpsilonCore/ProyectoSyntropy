FROM php:8.3-apache 
 
# Extensión para MySQL y módulos de Apache 
RUN docker-php-ext-install pdo_mysql \ 
 && a2enmod rewrite headers \ 
 && echo 'ServerTokens Prod' >> /etc/apache2/apache2.conf \ 
 && echo 'ServerSignature Off' >> /etc/apache2/apache2.conf 
 
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf 

WORKDIR /var/www/html 

 
COPY . . 
RUN chown -R www-data:www-data /var/www/html 
 
EXPOSE 80 
