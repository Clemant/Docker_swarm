FROM php:apache
RUN apt-get update
RUN a2enmod proxy && a2enmod proxy_http
RUN service apache2 restart
COPY ./apache_default.conf /etc/apache2/sites-available/000-default.conf 
