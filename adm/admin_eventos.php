<?php
session_start();

// Verificação de login
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

try {
    include "../backend/conexao.php";

    // Verificar se o formulário de adição de evento foi enviado
    if (isset($_POST['add_evento'])) {
        $evento = $_POST['evento'];
        $data_evento = $_POST['data_evento'];
        $descricao = $_POST['descricao'];

        // Inserir o novo evento na tabela
        $sql_insert = "INSERT INTO tb_eventos (evento, data_evento, descricao) VALUES (:evento, :data_evento, :descricao)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':evento', $evento);
        $stmt_insert->bindParam(':data_evento', $data_evento);
        $stmt_insert->bindParam(':descricao', $descricao);

        if ($stmt_insert->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erro ao adicionar evento.";
        }
    }

    // Selecionar todos os eventos
    $sql = "SELECT * FROM tb_eventos ORDER BY data_evento ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Eventos</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Área Restrita - Jornal Federal</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Site Principal</a></li>
                    <li><a href="adicionar_noticia.php">Adicionar Notícias</a></li>
                    <li><a href="deletar_noticia.php">Deletar Notícias</a></li>
                    <li><a href="admin_sugestoes.php">Ver Sugestões</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="container">
        <h2>Adicionar Novo Evento</h2>
        <form method="POST" action="">
            <label for="evento">Nome do Evento:</label>
            <input type="text" name="evento" id="evento" required>
            <label for="data_evento">Data do Evento:</label>
            <input type="date" name="data_evento" id="data_evento" required>
            <button type="submit" name="add_evento">Adicionar Evento</button>
        </form>


    <section class="container">
    <h2>Eventos Cadastrados</h2>
        <?php if (!empty($eventos)): ?>
            <ul>
                <?php foreach ($eventos as $evento): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($evento['evento'] ?? 'Evento sem nome'); ?></strong><br>
                        <?php echo date('d/m/Y', strtotime($evento['data_evento'] ?? '')); ?><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum evento cadastrado.</p>
        <?php endif; ?>
</section>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
