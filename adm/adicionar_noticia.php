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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $desc = $_POST['desc'];
    $img = $_POST['img'];
    $conteudo = $_POST['conteudo'];
    $data_cad = $_POST['data_cad'];

    // Inserir a notícia no banco de dados
    $sql = "INSERT INTO tb_jornal (titulo, `desc`, img, data_cad, conteudo) VALUES ('$titulo', '$desc', '$img', '$data_cad', '$conteudo')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Notícia adicionada com sucesso!";
    } else {
        $mensagem = "Erro ao adicionar notícia: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Notícia</title>
    <link rel="stylesheet" href="assets/css/modal.css">
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
    <h2>Adicionar Notícia</h2>

    <?php if (isset($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="adicionar_noticia.php">
        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label for="desc">Descrição:</label><br>
        <input type="text" name="desc" required><br><br>

        <label for="data_cad">Data:</label><br>
        <input type="date" name="data_cad" required><br><br>

        <label for="img">Imagem (URL ou caminho):</label><br>
        <input type="text" name="img"><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea name="conteudo" rows="5" cols="30" required></textarea><br><br>

        <button type="submit">Adicionar Notícia</button>
    </form>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
