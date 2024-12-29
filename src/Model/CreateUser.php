<?php

require_once 'Database.php';

use App\Model\Database;

if ($argc != 6) {
    echo "Uso: php CreateUser.php <nome> <email> <senha> <lon> <lat>\n";
    exit(1);
}

$nome = $argv[1];
$email = $argv[2];
$senha = $argv[3];
$lon = $argv[4];
$lat = $argv[5];

$db = new Database();
$conn = $db->connect();

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($nome, $email, $senha, $lon, $lat) {
        try {
            // Usando prepared statements para evitar injeção SQL
            $stmt = $this->conn->prepare('INSERT INTO "user" (nome, email, senha, lon, lat) 
                                          VALUES (:nome, :email, :senha, :lon, :lat)');

            // Vincular os parâmetros aos valores fornecidos
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindParam(':lon', $lon, PDO::PARAM_STR);
            $stmt->bindParam(':lat', $lat, PDO::PARAM_STR);

            // Executar a consulta
            $stmt->execute();

            echo "Usuário '$nome' criado com sucesso.\n";
        } catch (PDOException $e) {
            echo "Erro ao criar o usuário: " . $e->getMessage() . "\n";
        }
    }
}

$user = new User($conn);
$user->create($nome, $email, $senha, $lon, $lat);