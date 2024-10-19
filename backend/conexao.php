<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Deixe vazio se não houver senha
define('DB_NAME', 'db_jornal'); // Certifique-se de que este banco de dados existe

try {
    // Cria uma nova conexão PDO
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configura o modo de erro do PDO para exceções
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage()); // Logar o erro
    die("Erro na conexão com o banco de dados."); // Mensagem genérica
}
