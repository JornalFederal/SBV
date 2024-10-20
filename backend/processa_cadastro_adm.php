<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de conexão
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $usuario = $_POST['usuario']; // Nome do usuário
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $poderes = '1'; // Poderes sempre definido como 1

    try {
        // Verifica se o usuário já existe
        $check_sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt_check = $pdo->prepare($check_sql);
        $stmt_check->bindParam(':usuario', $usuario);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            // Define a mensagem de erro na sessão
            $_SESSION['erro_cadastro'] = "Usuário já existe. Escolha outro nome!";
            header("Location: ../adm/gerenciamento.php"); // Redireciona de volta para a página de cadastro
            exit();
        } else {
            // Insere o novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (usuario, nome, senha, poderes) VALUES (:usuario, :nome, :senha, :poderes)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':nome', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':poderes', $poderes);

            if ($stmt->execute()) {
                header("Location: ../adm/gerenciamento.php"); // Redireciona para o gerenciador após sucesso
                exit();
            } else {
                // Define uma mensagem de erro geral
                $_SESSION['erro_cadastro'] = "Erro ao cadastrar usuário.";
                header("Location: ../adm/gerenciamento.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        $_SESSION['erro_cadastro'] = "Erro: " . $e->getMessage();
        header("Location: ../adm/gerenciamento.php");
        exit();
    }
}
?>