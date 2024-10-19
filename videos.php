<?php
session_start();

try {
    include "backend/conexao.php";

    // Selecionar todas as notícias onde 'midia' não é NULL (notícias com vídeos)
    $sql = "SELECT * FROM tb_jornal WHERE midia IS NOT NULL ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $noticiasComVideos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $err) {
    echo "Erro: " . $err->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP SBV - Vídeos</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/modal.js" defer></script> <!-- Incluindo o arquivo JS -->
</head>

<body>
    <header id="header">
        <div class="container">
            <img src="assets/img/logojornal.png" alt="" height="80px">
            <nav>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="todas-noticias.php">Notícias</a></li>
                    <li><a href="videos.php" class="active">Vídeos</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="sugestoes.php">Sugestões</a></li>
                    <li><a href="jornal.php">PDF's</a></li>
                    <?php
                    if (isset($_SESSION['adm_logado']))
                        if ($_SESSION['adm_logado'] == true) {
                            echo "<li><a href=adm/painel.php>Admin</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <section id="noticias" class="container">
        <h2>Notícias Gravadas</h2>

        <?php if (!empty($noticiasComVideos)): ?>
            <?php foreach ($noticiasComVideos as $noticia): ?>
                <div class="noticia" id="video">
                    <div class="news-video">
                        <!-- Miniatura do vídeo -->
                        <img src="<?php echo $noticia['img'] ?: 'assets/img/placeholder.png'; ?>" alt="Imagem do vídeo" class="thumbnail"
                            onclick="abrirModal('<?php echo $noticia['midia']; ?>',
                                                    '<?php echo htmlspecialchars($noticia['titulo']); ?>',
                                                    `<?php echo htmlspecialchars($noticia['conteudo']); ?>`)">
                    </div>
                    <div class="news-content">
                        <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                        <p><?php echo htmlspecialchars($noticia['desc']); ?></p>
                        <p class="data"><?php echo date('d/m/Y', strtotime($noticia['data_cad'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma notícia com vídeo disponível no momento.</p>
        <?php endif; ?>
    </section>

    <!-- Overlay para escurecer a página de fundo -->
    <div id="overlay" class="overlay"></div>

    <!-- Modal para exibição do vídeo -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <div class="closex" id="closeModal">x</div>
            <h2 class="news-video-title" id="modalTitulo"></h2>
            <div class="video-container"><iframe id="videoFrame" src="" frameborder="0" allowfullscreen></iframe></div>
            <p id="modalConteudo"></p> <!-- Parágrafo para o conteúdo -->
            <p class="close" id="closeModal">Sair</p>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="assets/js/scroll.js"></script>
</body>

</html>