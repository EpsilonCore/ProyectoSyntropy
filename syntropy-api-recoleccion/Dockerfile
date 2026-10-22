FROM php:8.3-apache

RUN docker-php-ext-install mysqli \
 && a2enmod rewrite headers \
 && echo 'ServerTokens Prod' >> /etc/apache2/apache2.conf \
 && echo 'ServerSignature Off' >> /etc/apache2/apache2.conf \
 && mkdir -p /sesiones && chown www-data:www-data /sesiones \
 && echo 'session.save_path=/sesiones' > /usr/local/etc/php/conf.d/sesiones.ini

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
