# Usar la imagen oficial de MariaDB como base
FROM mariadb:latest

# Establecer variables de entorno para MariaDB
ENV MYSQL_ROOT_PASSWORD=my-secret-pw
ENV MYSQL_DATABASE=mydatabase
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword

# Exponer el puerto 3306
EXPOSE 3306

# Comando para iniciar MariaDB
CMD ["mysqld"]
