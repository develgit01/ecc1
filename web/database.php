<?php

class Database{
	//Conexion a la base de datos
	public function connect(){	
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
}

?>