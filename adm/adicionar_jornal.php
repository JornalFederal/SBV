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
    
    // Verificar se o formulário de upload foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['arquivo_pdf'])) {
        $titulo = $_POST['titulo'] ?? NULL; // Campo obrigatório
        
        $arquivo = $_FILES['arquivo_pdf'];
        $nomeArquivo = basename($arquivo['name']);
        $caminhoDestino = '../uploads/pdf/' . uniqid() . '_' . $nomeArquivo;

        // Verificar se o arquivo é realmente PDF
        if (strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION)) === 'pdf') {
            // Tentar mover o arquivo para o diretório de uploads
            if (move_uploaded_file($arquivo['tmp_name'], $caminhoDestino)) {
                // Inserir informações no banco de dados
                $sql = "INSERT INTO tb_jornal_pdf (titulo, nome_arquivo) VALUES (:titulo, :nome_arquivo)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':titulo', $titulo);
                $stmt->bindParam(':nome_arquivo', $caminhoDestino);
                $stmt->execute();

                // Redirecionar após o upload
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $mensagem = "Erro ao enviar o arquivo.";
            }
        } else {
            $mensagem = "Apenas arquivos PDF são permitidos.";
        }
    }
    
    // Selecionar os PDFs já cadastrados
    $sql_select = "SELECT * FROM tb_jornal_pdf ORDER BY id DESC";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->execute();
    $jornal_pdfs = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
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