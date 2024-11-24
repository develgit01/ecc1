# Usar la imagen oficial de MariaDB como base
FROM mariadb:latest

# Instalar el cliente de MariaDB
RUN apt-get update && apt-get install -y mariadb-client

# Establecer variables de entorno para MariaDB
ENV MYSQL_ROOT_PASSWORD=my-secret-pw
ENV MYSQL_DATABASE=mydatabase
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword

# Exponer el puerto 3306
EXPOSE 3306

# Copiar el script de inicio personalizado al contenedor
COPY start.sh /usr/local/bin/start.sh

# Hacer el script ejecutable
RUN chmod +x /usr/local/bin/start.sh

# Comando para iniciar el contenedor usando el script de inicio personalizado
CMD ["/usr/local/bin/start.sh"]
