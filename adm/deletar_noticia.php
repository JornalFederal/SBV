<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado'])) {
    header('Location: login.php'); // Redireciona para login.php se não estiver logado
    exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_jornal";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Deleta a notícia se o ID for passado via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza o valor do ID para garantir que seja um número inteiro

    // Consulta para deletar a notícia
    $sql = "DELETE FROM tb_jornal WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Notícia deletada com sucesso!";
    } else {
        $mensagem = "Erro ao deletar notícia: " . $conn->error;
    }
}

// Recupera todas as notícias para listar
$sql = "SELECT id, titulo, `desc`, data_cad FROM tb_jornal";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Notícias</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Jornal Estudantil IFSP São João da Boa Vista</h1>
            <nav>
                    <ul>
                        <li><a href="index.php">Início</a></li>
                        <li><a href="todas-noticias.php">Notícias</a></li>
                        <li><a href="videos.php">Vídeos</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                        <li><a href="sugestoes.php">Sugestões</a></li>
                    </ul>
            </nav>
        </div>
    </header>
<body>
    <h2>Lista de Notícias</h2>

    <?php if (isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["titulo"]; ?></td>
                    <td><?php echo $row["desc"]; ?></td>
                    <td><?php echo $row["data_cad"]; ?></td>
                    <td>
                        <a href="deletar_noticia.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar esta notícia?');">
                            Deletar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhuma notícia encontrada.</td>
            </tr>
        <?php endif; ?>
    </table>

    <p><a href="adicionar_noticia.php">Adicionar Nova Notícia</a> | <a href="logout.php">Sair</a></p>
</body>
</html>
