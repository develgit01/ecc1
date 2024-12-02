<?php

// DATABASE_HOST=ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.app
// DATABASE_USER=koyeb-adm
// DATABASE_PASSWORD=JIncLkX2yp9E
// DATABASE_NAME=koyebdb

class Database {
    private static $instance = null;
    private $pdo;
    private $db;

    private function __construct() {
        $host = "ep-restless-bird-a2xx2dqs.eu-central-1.pg.koyeb.app";
        $db = "koyebdb";
        $user = "koyeb-adm";
        $pass = "JIncLkX2yp9E";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}

