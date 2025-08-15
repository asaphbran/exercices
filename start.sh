#!/bin/sh

# Iniciar PHP-FPM en segundo plano.
php-fpm -D

# Iniciar Nginx en primer plano para que el contenedor no se detenga.
nginx -g "daemon off;"
