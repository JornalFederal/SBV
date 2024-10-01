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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $desc = $_POST['desc'];
    $img = $_POST['img'];
    $midia = $_POST['midia'];
    $video_duration = $_POST['video_duration']; // Obtendo a duração do vídeo
    $conteudo = $_POST['conteudo'];
    $data_cad = $_POST['data_cad'];

    // Inserir a notícia no banco de dados
    $sql = "INSERT INTO tb_jornal (titulo, `desc`, img, midia, video_duration, data_cad, conteudo) VALUES ('$titulo', '$desc', '$img', '$midia', '$video_duration', '$data_cad', '$conteudo')";

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
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Área Restrita - Jornal Federal</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Site Principal</a></li>
                    <li><a href="deletar_noticia.php">Deletar Notícias</a></li>
                    <li><a href="admin_sugestoes.php">Ver Sugestões</a></li>
                    <li><a href="admin_eventos.php">Editar Eventos</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <h2 style="color: #00510f; text-align: center; margin: 20px 0; font-size: 40px;">Adicionar Notícia</h2>

        <?php if (isset($mensagem)): ?>
            <h2 style="text-align: center;"><?php echo $mensagem; ?></h2>
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

            <label for="midia">Mídia (URL ou caminho):</label><br>
            <input type="text" name="midia"><br><br>

            <label for="video_duration">Duração do Vídeo:</label><br>
            <input type="text" name="video_duration" placeholder="Ex: 3 min"><br><br> <!-- Campo para duração do vídeo -->

            <label for="conteudo">Conteúdo:</label><br>
            <textarea name="conteudo" rows="5" cols="30"></textarea><br><br>

            <button type="submit">Adicionar Notícia</button>
        </form>
        
        <div class="center"><a href="logout.php">Sair</a></div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
