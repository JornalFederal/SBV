<?php
// Parâmetros de conexão
$dsn = "mysql:host=localhost;dbname=db_jornal";
$username = "root";
$password = "";

try {
    // Cria uma nova instância de PDO para conectar ao banco de dados
    $pdo = new PDO($dsn, $username, $password);
    $conn = new PDO($dsn, $username, $password);
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
}
?>