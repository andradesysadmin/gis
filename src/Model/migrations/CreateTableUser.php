<?php

require_once __DIR__ . '/../Database.php';  
use App\Model\Database;

$db = new Database();
$conn = $db->connect(); 

class CreateTableUser {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert() {
        try {
            $this->conn->query('CREATE TABLE IF NOT EXISTS "user" (
                id SERIAL PRIMARY KEY, 
                nome VARCHAR(100) NOT NULL, 
                email VARCHAR(100) UNIQUE NOT NULL, 
                lon VARCHAR(255) NOT NULL, 
                lat VARCHAR(255) NOT NULL,
                senha VARCHAR(255) NOT NULL, 
                criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );');
            echo "Tabela 'user' criada com sucesso.\n";
        } catch (PDOException $e) {
            echo "Erro ao criar a tabela: " . $e->getMessage() . "\n";
        }
    }
}

$tableCreator = new CreateTableUser($conn);
$tableCreator->insert();