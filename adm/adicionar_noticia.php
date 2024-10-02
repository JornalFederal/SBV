<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_jornal";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'] ?? NULL; // Campo obrigatório
    $desc = $_POST['desc'] ?? NULL; // Campo obrigatório
    $midia = !empty($_POST['midia']) ? $_POST['midia'] : NULL; // Permite que midia seja NULL
    $video_duration = !empty($_POST['video_duration']) ? $_POST['video_duration'] : NULL; // Permite que video_duration seja NULL
    $conteudo = !empty($_POST['conteudo']) ? $_POST['conteudo'] : NULL; // Permite que conteudo seja NULL
    $data_cad = $_POST['data_cad'] ?? NULL; // Campo obrigatório

    // Diretório de upload de imagem
    $target_dir = "../uploads/"; // Corrigido o caminho para uploads
    $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . "." . $imageFileType;

    // Verifica se o diretório existe, se não, cria
    if (!is_dir($target_dir)) {
        if (mkdir($target_dir, 0755, true)) {
            echo "Pasta 'uploads/' criada com sucesso.";
        } else {
            echo "Falha ao criar a pasta 'uploads/'.";
        }
    }

    // Verifica se o arquivo de imagem foi enviado
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Verifica o tipo do arquivo
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Tenta mover o arquivo para a pasta de uploads
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $img = "./uploads/" . basename($target_file); // Caminho relativo a ser armazenado no banco de dados
                } else {
                    $mensagem = "Desculpe, houve um erro ao enviar sua imagem.";
                }
            } else {
                $mensagem = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
            }
        } else {
            $mensagem = "O arquivo não é uma imagem.";
        }
    } else {
        $img = NULL; // Caso nenhuma imagem seja enviada
    }

    // Inserir a notícia no banco de dados
    $sql = "INSERT INTO tb_jornal (titulo, `desc`, img, midia, video_duration, data_cad, conteudo) 
            VALUES ('$titulo', '$desc', '$img', " . ($midia ? "'$midia'" : "NULL") . ", " . ($video_duration ? "'$video_duration'" : "NULL") . ", '$data_cad', " . ($conteudo ? "'$conteudo'" : "NULL") . ")";

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

        <?php if (!empty($mensagem)): ?>
            <h2 style="text-align: center;"><?php echo $mensagem; ?></h2>
        <?php endif; ?>

        <form method="POST" action="adicionar_noticia.php" enctype="multipart/form-data">
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" required><br><br>

            <label for="desc">Descrição:</label><br>
            <input type="text" name="desc" required><br><br>

            <label for="data_cad">Data:</label><br>
            <input type="date" name="data_cad" required><br><br>

            <label for="img">Imagem (upload):</label><br>
            <input type="file" name="img" accept="image/*"><br><br>

            <label for="midia">Mídia (URL ou caminho):</label><br>
            <input type="text" name="midia"><br><br>

            <label for="video_duration">Duração do Vídeo:</label><br>
            <input type="text" name="video_duration" placeholder="Ex: 3 min"><br><br>

            <label for="conteudo">Conteúdo:</label><br>
            <textarea name="conteudo" rows="5" cols="30"></textarea><br><br>

            <button type="submit">Adicionar Notícia</button>
        </form>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>