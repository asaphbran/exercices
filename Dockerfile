# Usar la imagen base de PHP-FPM, que ya incluye PHP y el servidor de procesos FastCGI.
# 'cli' se incluye para poder ejecutar comandos de la consola.
FROM php:8.3-fpm-alpine

# Instalar Nginx para servir el contenido web. 'alpine' es una versión ligera de Linux.
RUN apk add --no-cache nginx

# Copiar el archivo de configuración de Nginx.
# La configuración 'nginx.conf' se encarga de dirigir las peticiones
# a la aplicación PHP a través de PHP-FPM.
COPY nginx.conf /etc/nginx/nginx.conf

# Copiar el script de inicio y darle permisos de ejecución.
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Copiar el código de la aplicación PHP al contenedor.
# La aplicación se copiará al directorio 'html' de Nginx.
COPY . /var/www/html/

# Exponer el puerto 80 del contenedor, que es el puerto predeterminado de Nginx.
EXPOSE 80

# Usar el formato de array (exec form) para el comando CMD,
# lo que soluciona el aviso de Inteliphense.
CMD ["start.sh"]
