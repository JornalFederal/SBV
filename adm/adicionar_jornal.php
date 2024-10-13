<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

require_once("../backend/conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../uploads/pdf/";
    $fileType = strtolower(pathinfo($_FILES["jornal"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . "." . $fileType;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if ($fileType === "pdf") {
        if ($_FILES["jornal"]["size"] <= 5000000) { // Limitar para 5MB
            if (move_uploaded_file($_FILES["jornal"]["tmp_name"], $target_file)) {
                $mensagem = "PDF adicionado com sucesso!";
            } else {
                $mensagem = "Erro ao fazer o upload do PDF.";
            }
        } else {
            $mensagem = "O arquivo é muito grande. O limite é de 5MB.";
        }
    } else {
        $mensagem = "Apenas arquivos PDF são permitidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload de Jornal</title>
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
        <h2>Upload de Jornal (PDF)</h2>

        <?php if (!empty($mensagem)): ?>
            <p style="color: red;"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data" class="forms">
            <label for="titulo">Título do Jornal:</label>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="arquivo_pdf">Selecione o PDF:</label>
            <input type="file" name="arquivo_pdf" id="arquivo_pdf" accept="application/pdf" required><br>

            <button type="submit">Enviar Jornal</button>
        </form>
    </section>

    <section class="container">
        <h2>Jornais Enviados</h2>
        <?php if (!empty($jornal_pdfs)): ?>
            <ul>
                <?php foreach ($jornal_pdfs as $jornal): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($jornal['titulo']); ?></strong><br>
                        <a href="<?php echo $jornal['nome_arquivo']; ?>" download>Baixar PDF</a><br><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum jornal enviado.</p>
        <?php endif; ?>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>