#!/bin/bash
# Iniciar MariaDB en segundo plano
docker-entrypoint.sh mariadbd &

# Esperar a que MariaDB esté listo
until mysqladmin ping -hlocalhost --silent; do
  echo "Esperando a que MariaDB esté listo..."
  sleep 1
done

# Realizar configuraciones adicionales si es necesario
# Ejemplo: Crear una base de datos y un usuario
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';"
mysql -u root -p$MYSQL_ROOT_PASSWORD -e "FLUSH PRIVILEGES;"

# Mantener el contenedor en ejecución
tail -f /dev/null
