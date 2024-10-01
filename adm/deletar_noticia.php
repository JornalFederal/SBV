<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Salva a URL atual para redirecionar após o login
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
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

// Deleta múltiplas notícias
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ids'])) {
    // Verifica se algum ID foi selecionado
    $ids = $_POST['ids']; // Recupera os IDs das notícias selecionadas

    // Converte os IDs para uma lista separada por vírgula para usar na consulta SQL
    $idList = implode(",", array_map('intval', $ids));

    // Consulta SQL para deletar as notícias selecionadas
    $sql = "DELETE FROM tb_jornal WHERE id IN ($idList)";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Notícias deletadas com sucesso!";
    } else {
        $mensagem = "Erro ao deletar notícias: " . $conn->error;
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
            <h1>Área Restrita - Jornal Federal</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Site Principal</a></li>
                    <li><a href="adicionar_noticia.php">Adicionar Notícias</a></li>
                    <li><a href="admin_sugestoes.php">Ver Sugestões</a></li>
                    <li><a href="admin_eventos.php">Editar Eventos</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <h2>Lista de Notícias</h2>

    <?php if (isset($mensagem)): ?>
        <p class="center"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="deletar_noticia.php">
        <table border="1">
            <tr>
                <th>Selecionar</th> <!-- Nova coluna para checkbox -->
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="<?php echo $row['id']; ?>"></td> <!-- Checkbox para selecionar -->
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["titulo"]; ?></td>
                        <td><?php echo $row["desc"]; ?></td>
                        <td><?php echo $row["data_cad"]; ?></td>
                        <td>
                            <a href="deletar_noticia.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar esta notícia?');">
                                Deletar Individualmente
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhuma notícia encontrada.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Botão para deletar múltiplas notícias -->
        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar as notícias selecionadas?');">Deletar Selecionadas</button>
    </form>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>

