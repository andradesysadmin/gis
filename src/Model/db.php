<?php

namespace App\Model;
use PDO;

class Database {
    private $host = "localhost";
    private $dbname = "postgres";
    private $username = "postgres";
    private $password = "postgres";
    private $conn;

    public function connect() {
        $dsn = "pgsql:host=" . $this->host . ";dbname=" . $this->dbname;
        try {
            $this->conn = new \PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            return null;
        }
    }

    public function disconnect() {
        $this->conn = null;
    }
}
?>