<?php
namespace App\Models;

use App\System\Database;
use PDO;

class ResourceModel {
    private $tableName;
    private $pdo;

    public function __construct($tableName) {
        $this->tableName = $tableName;
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM $this->tableName");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName (name) VALUES (:name)");
        $stmt->execute(['name' => $data['name']]);
    }
}
