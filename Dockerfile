# Usar una imagen base de Ubuntu
FROM ubuntu:20.04

# Instalar MySQL Server
RUN apt-get update && apt-get install -y \
    mysql-server \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar MySQL
RUN service mysql start && \
    mysql -u root -e "CREATE DATABASE mydatabase;" && \
    mysql -u root -e "CREATE USER 'myuser'@'localhost' IDENTIFIED BY 'mypassword';" && \
    mysql -u root -e "GRANT ALL PRIVILEGES ON mydatabase.* TO 'myuser'@'localhost';" && \
    mysql -u root -e "FLUSH PRIVILEGES;"

# Exponer el puerto 3306 para MySQL
EXPOSE 3306

# Comando para ejecutar MySQL
CMD ["mysqld"]
