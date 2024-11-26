<?php

namespace App\Database\Connections;

use CodeIgniter\Database\BaseConnection;
use PDO;
use PDOException;

class PooledConnection extends BaseConnection
{
    protected $pool = [];
    protected $maxConnections = 10;
    protected $currentConnections = 0;

    public function __construct(array $params)
    {
        parent::__construct($params);
        log_message('info', 'PooledConnection constructed');
    }

    public function connect(bool $persistent = false)
    {
        log_message('info', 'Attempting to connect to the database');
        if ($this->currentConnections < $this->maxConnections) {
            $dsn = 'mysql:host=' . $this->hostname . ';dbname=' . $this->database;
            $this->connID = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $this->pool[] = $this->connID;
            $this->currentConnections++;
            log_message('info', 'Connected to the database');
        } else {
            throw new PDOException('Maximum number of connections reached.');
        }
    }

    public function close()
    {
        log_message('info', 'Closing database connection');
        $index = array_search($this->connID, $this->pool);
        if ($index !== false) {
            unset($this->pool[$index]);
            $this->currentConnections--;
        }
        $this->connID = null;
        log_message('info', 'Database connection closed');
    }
}

