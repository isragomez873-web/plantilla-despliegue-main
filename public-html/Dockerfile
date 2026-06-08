FROM php:8.3-apache

ENV ACCEPT_EULA=Y

RUN apt-get update && apt-get install -y nano wget gnupg2

# Configura las variables de entorno para configuración adicional
ENV SOURCE=pre-proyecto  
ENV ENDPOINT=mysql-proyecto 
ENV DATABASE=proyecto
ENV USERD=user
ENV PASSD=psswrd-proyecto-user!
ENV SIMPLE=simple-proyecto

# Instalar dependencias del sistema, limpiar cache y configurar Apache para correr como non-root
RUN apt-get update && apt-get install -y --no-install-recommends \
  gnupg2 nano wget \
  && rm -rf /var/lib/apt/lists/* \
  && chown -R www-data:www-data /var/www /var/run/apache2 /var/log/apache2 /var/lock/apache2

# Copiar archivos al contenedor (con permisos para www-data)
RUN mkdir -p /var/www/proyecto/public_content /var/www/private_content && \
  chown -R www-data:www-data /var/www/proyecto /var/www/private_content
COPY --chown=www-data:www-data ./app /var/www/proyecto
COPY --chown=www-data:www-data ./simplesaml /var/www/simplesaml

# Configurar PHP
RUN echo "session.save_path=\"/tmp\"" >> /usr/local/etc/php/php.ini && \
  echo "display_errors = Off" >> /usr/local/etc/php/php.ini && \
  echo "log_errors = On" >> /usr/local/etc/php/php.ini

# Install SqlServer PHP driver
# RUN cat /etc/os-release \
#   && apt-get update \
#   && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
#   && curl https://packages.microsoft.com/config/ubuntu/22.04/prod.list \
#       > /etc/apt/sources.list.d/mssql-release.list \
#   && apt-get install -y --no-install-recommends apt-transport-https \
#   && apt-get update \
#   && ACCEPT_EULA=Y apt-get -y --no-install-recommends install unixodbc-dev msodbcsql17

# Install PHP extensions
RUN docker-php-ext-install calendar pdo_mysql mysqli
# && pecl install sqlsrv pdo_sqlsrv \
# && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Habilita mod_rewrite en Apache
COPY --chown=www-data:www-data 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Cambiar al usuario www-data
USER www-data

EXPOSE 80
