<?php
session_start();

// Verificação de login
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

try {
    // Inclua a conexão com o banco de dados
    include "../backend/conexao.php";

    // Verificar se o formulário de exclusão foi enviado
    if (isset($_POST['delete_sugestao'])) {
        $id_sugestao = $_POST['id_sugestao'];

        // Deletar a sugestão pelo ID
        $sql_delete = "DELETE FROM tb_sugestoes WHERE id = :id";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bindParam(':id', $id_sugestao, PDO::PARAM_INT);

        if ($stmt_delete->execute()) {
            // Redireciona para a mesma página para evitar reenviar o formulário ao atualizar
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao deletar sugestão.";
        }
    }

    // Selecionar todas as sugestões
    $sql = "SELECT * FROM tb_sugestoes ORDER BY data_envio DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch de todas as sugestões do banco
    $sugestoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sugestões</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header id="header">
        <div class="container">
            <img src="../assets/img/logojornal.png" alt="" height="80px">
            <nav>
                <ul>
                    <li><a href="../index.php">Visualizar</a></li>
                    <li><a href="painel.php">Notícias</a></li>
                    <li><a href="admin_eventos.php">Eventos</a></li>
                    <li><a href="admin_sugestoes.php" class="active">Sugestões</a></li>
                    <li><a href="adicionar_jornal.php">Jornal</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="container">
        <h2 class="tit">Sugestões Recebidas</h2>
        <?php if (!empty($sugestoes)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sugestão</th>
                        <th>Data</th>
                        <th>Ação</th> <!-- Nova coluna para o botão de exclusão -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sugestoes as $sugestao): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sugestao['nome']); ?></td>
                            <td><?php echo htmlspecialchars($sugestao['sugestao']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($sugestao['data_envio'])); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_sugestao" value="<?php echo $sugestao['id']; ?>">
                                    <button type="submit" name="delete_sugestao" class="btn-delete">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma sugestão enviada ainda.</p>
        <?php endif; ?>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>