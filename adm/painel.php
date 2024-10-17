<!-- Painel de Administrador -->

<?php
    session_start();

    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
        header("Location: login.php");
        exit();
    }

    require_once("../backend/conexao.php");

    $sql = "SELECT * FROM tb_jornal WHERE midia IS NULL ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $noticiasSemVideos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM tb_jornal WHERE midia IS NOT NULL ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $noticiasComVideos = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (isset($_GET['id'])) { //Deletar notícia individual
        $id = intval($_GET['id']); // Garante que o ID seja um número inteiro
        $sql = "DELETE FROM tb_jornal WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $mensagem = "Notícia deletada com sucesso!";
        } else {
            $mensagem = "Erro ao deletar notícia: " . $conn->error;
        }
    
        $stmt->close();
    }

    $mensagem = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP SBV</title>
    <link rel="stylesheet" href="../assets/css/modal.css">
    <script src="../assets/js/modal.js" defer></script> <!-- Incluindo o arquivo JS -->
    <script src="https://kit.fontawesome.com/7ea58ad5b7.js" crossorigin="anonymous"></script>
</head>
<body>
    <header id="header">
        <div class="container">
            <img src="../assets/img/logojornal.png" alt="" height="80px" >
            <nav>
                <ul>
                    <li><a href="../index.php">Visualizar</a></li>  <!-- Class Active indica com bold a página atual -->
                    <li><a href="painel.php" class="active">Notícias</a></li>
                    <li><a href="admin_eventos.php">Eventos</a></li>
                    <li><a href="admin_sugestoes.php">Sugestões</a></li>
                    <li><a href="adicionar_jornal.php">Jornal</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="noticias" class="container">
        <div style="display: flex; align-items: center; justify-content: space-between">
            <h2>Todas as Notícias</h2>
            <a href="adicionar_noticia.php"><button style="height: max-content; padding: 10px">Adicionar Notícia</button></a>
            <a href="deletar_noticia.php"><button style="height: max-content; padding: 10px">Deletar em massa</button></a>
        </div>
        <?php foreach ($noticiasSemVideos as $item): ?>
            <div class="noticia">
                <div class="noticia_adm"> <!-- Flex / para deixar na mesma linha -->
                    <a href="../noticias.php?id=<?php echo $item['id']; ?>" class="">
                        <h2><?php echo htmlspecialchars($item['titulo']); ?></h2>
                    </a>
                    <a href="editar_noticia.php?id=<?php echo $item['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a> <!--- Editar --->
                    <a href="painel.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar esta notícia?');">
                        <i class="fa-solid fa-trash"></i>
                    </a> <!--- Excluir --->
                </div>
                <p><?php echo htmlspecialchars($item['desc']); ?></p>
                <p class="data"><?php echo date('d/m/Y', strtotime($item['data_cad'])); ?></p>
            </div>
        <?php endforeach; ?>
        <?php foreach ($noticiasComVideos as $item): ?>
                <div class="noticia" id="video">
                        <div class="news-video">
                            <!-- Miniatura do vídeo -->
                            <img src="<?php echo $item['img'] ?: 'assets/img/placeholder.jpg'; ?>" alt="Imagem do vídeo" class="thumbnail"
                                onclick="abrirModal('<?php echo $item['midia']; ?>',
                                                    '<?php echo htmlspecialchars($item['titulo']); ?>',
                                                    `<?php echo htmlspecialchars($item['conteudo']); ?>`)">
                        </div>
                        <div class="news-content">
                            <a href="../noticias.php?id=<?php echo $item['id']?>" class="">
                                <h2><?php echo htmlspecialchars($item['titulo']); ?></h2>
                            </a>    
                            <p><?php echo htmlspecialchars($item['desc']); ?></p>
                            <p class="data"><?php echo date('d/m/Y', strtotime($item['data_cad'])); ?></p>
                        </div>
                </div>
            <?php endforeach; ?>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="../assets/js/scroll.js"></script>
</body>
</html>
