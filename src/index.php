<?php

//require 'public/index.php';

$dsn = 'pdo:host=db;dbname=my_database';
$username = 'user';
$password = 'user_password';

try {
    $pdo = new PDO($dsn, $username, $password);
    echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}