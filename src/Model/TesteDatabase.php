<?php

require_once __DIR__ . '/Database.php'; 

//Chamando a classe Database
use App\Model\Database;
use PDO;

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "Conexão bem-sucedida ao banco de dados!\n";

    try {
        $query = $conn->query("SELECT version();");
        $version = $query->fetch(\PDO::FETCH_ASSOC);
        echo "Versão do PostgreSQL: " . $version['version'] . "\n";
    } catch (\PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage() . "\n";
    }

    $db->disconnect();
} else {
    echo "Falha na conexão com o banco de dados.\n";
}
