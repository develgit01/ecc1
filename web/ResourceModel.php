<?php

require_once "database.php";

class ResourceModel {
    private $table;
    private $conn;
    
	// private $cnx;
	// public function __construct(){
	// 	$this->cnx=conexion::conex();
	// }

    public function __construct($table) {
        $db = new Database();
        $this->conn = $db->connect();
        $this->table = $table;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $email) {
        $query = "INSERT INTO {$this->table} (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function save($data) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name) VALUES (:name)");
        $stmt->execute(['name' => $data['name']]);
    }
}

