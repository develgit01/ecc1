# Usar una imagen base de Ubuntu


# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    debconf-utils \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Preconfigurar MySQL para evitar la interacción interactiva
RUN echo "mysql-server mysql-server/root_password password rootpassword" | debconf-set-selections && \
    echo "mysql-server mysql-server/root_password_again password rootpassword" | debconf-set-selections && \
    echo "mysql-server mysql-server/data-dir select ''" | debconf-set-selections && \
    echo "mysql-server mysql-server/start_on_boot boolean true" | debconf-set-selections && \
    echo "mysql-server mysql-server/default-auth-override select ''" | debconf-set-selections && \
    echo "mysql-server mysql-server/default-auth-override-warning select ''" | debconf-set-selections && \
    echo "mysql-server mysql-server/remove-data-dir boolean false" | debconf-set-selections && \
    echo "mysql-server mysql-server/really_downgrade boolean true" | debconf-set-selections

# Instalar MySQL Server
RUN apt-get update && apt-get install -y \
    mysql-server \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar MySQL
RUN service mysql start && \
    mysql -u root -prootpassword -e "CREATE DATABASE mydatabase;" && \
    mysql -u root -prootpassword -e "CREATE USER 'myuser'@'localhost' IDENTIFIED BY 'mypassword';" && \
    mysql -u root -prootpassword -e "GRANT ALL PRIVILEGES ON mydatabase.* TO 'myuser'@'localhost';" && \
    mysql -u root -prootpassword -e "FLUSH PRIVILEGES;"

# Exponer el puerto 3306 para MySQL
EXPOSE 3306

# Comando para ejecutar MySQL
CMD ["mysqld"]
