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

class ODBC{
  //Conexion a la base de datos
  public static function connection(){  
    $host = 'ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.app';
    $dbname = 'koyebdb';
    $username = 'koyeb-adm';
    $password = 'JIncLkX2yp9E';
    try{
      $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8",$username,$password);
    return $pdo;
   }catch(PDOException $e){
      echo $e->getMessage();
   }
}

$dbconex = new ODBC;
if($dbconex->conex()){
  echo "Conectado";
}else{
  echo "Revise la conexión de su Base de datos.";
}

}
?>
  </body>
</html>
