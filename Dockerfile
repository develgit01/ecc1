FROM debian:buster-slim

# Actualizar el sistema de paquetes
RUN apt-get update && apt-get install -y \
    mariadb-server \
    default-libmysqlclient-dev


# Exponer el puerto 3306 para conexiones remotas
EXPOSE 3306

# Establecer el directorio de datos de MariaDB
VOLUME /var/lib/mysql
# Configurar MariaDB
COPY mariadb.conf /etc/mysql/mariadb.conf.d/50-my-conf.cnf

# Iniciar el servidor MariaDB en primer plano
CMD ["mysqld"]