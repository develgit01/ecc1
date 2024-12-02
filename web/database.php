<?php

class Database {
    private $host = "ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.app";
    private $dbname = "koyebdb";
    private $user = "koyeb-adm";
    private $pass = "JIncLkX2yp9E";
    private $charset = 'utf8mb4';
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.ap;dbname=koyebdb",
                "koyeb-adm",
                "JIncLkX2yp9E"
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->conn;
    }
}
