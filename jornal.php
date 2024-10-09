<?php
try {
    include "backend/conexao.php";

    // Selecionar os PDFs disponíveis
    $sql = "SELECT * FROM tb_jornal_pdf ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $jornais = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornais Disponíveis</title>
    <link rel="stylesheet" href="assets/css/modal.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Jornal Estudantil IFSP</h1>
            <nav>
                <ul>
                <li><a href="index.php">Início</a></li>
                    <li><a href="todas-noticias.php">Notícias</a></li>
                    <li><a href="videos.php">Vídeos</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="sugestoes.php">Sugestões</a></li>
                    <li><a href="jornal.php">PDF's</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Jornais Disponíveis para Download</h2>
        <?php if (!empty($jornais)): ?>
            <ul>
                <?php foreach ($jornais as $jornal): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($jornal['titulo']); ?></strong><br>
                        <a href="<?php echo $jornal['nome_arquivo']; ?>" download>Baixar PDF</a><br><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum jornal disponível.</p>
        <?php endif; ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>