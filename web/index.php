<!DOCTYPE html>
<html>
  <head>
    <title>Example PHP page</title>
  </head>
  <body>
    <?php
      echo '<h1>Hello world!</h1>';
      echo '<p>This page uses PHP version '
          . phpversion()
          . '.</php';
    ?>
    <hr>
<?php

class ODBC {
  // Conexión a la base de datos
  public static function connection() {  
    $host = 'ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.app';
    $port = '5432';
    $dbname = 'koyebdb';
    $username = 'koyeb-adm';
    $password = 'JIncLkX2yp9E';
    try {
      // Cambiar el DSN para PostgreSQL
      $pdo = new PDO("pgsql:host=".$host.";port=".$port.";dbname=".$dbname, $username, $password);
      // Establecer atributos de PDO
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      // Imprimir mensaje de error en caso de fallo
      echo "Error de conexión: " . $e->getMessage();
      return null;
    }
  }
}

// Probar la conexión
$dbconex = ODBC::connection();
if ($dbconex) {
  echo "Conectado a PostgreSQL exitosamente.";
  
  try {
      // Obtener los usuarios
      $stmt = $dbconex->query("SELECT * FROM users");
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Mostrar resultados
      echo "<pre>";
      print_r($users);
      echo "</pre>";

  } catch (PDOException $e) {
      echo "Error al consultar usuarios: " . $e->getMessage();
  }
} else {
  echo "Revise la conexión de su base de datos.";
}

?>
  </body>
</html>
