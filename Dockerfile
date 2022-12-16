FROM php:8.0-apache


COPY ./site/apache/hospital_conf.conf /etc/apache2/conf-available/
COPY ./site/apache/hospital_site.conf /etc/apache2/sites-available/


RUN chown -R www-data:www-data /var/www/html/
#RUN a2disconf 000-default
#RUN a2enconf /etc/apache2/conf-available/hospital_conf.conf
#RUN a2ensite hospital_site.conf
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
