<?php

session_start();

try {
    include "backend/conexao.php";

    // Selecionar todas as notícias onde "midia" é NULL e ordenar por ID em ordem decrescente
    $sql = "SELECT * FROM tb_jornal WHERE midia IS NULL ORDER BY id DESC";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    // Pegar todas as notícias do banco de dados
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $err) {
    echo "Erro: " . $err->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header id="header">
        <div class="container">
            <img src="assets/img/logojornal.png" alt="" height="80px">
            <nav>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="todas-noticias.php" class="active">Notícias</a></li>
                    <li><a href="videos.php">Vídeos</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="sugestoes.php">Sugestões</a></li>
                    <li><a href="jornal.php">PDF's</a></li>
                    <?php
                    if (isset($_SESSION['adm_logado']))
                        if ($_SESSION['adm_logado'] == true) {
                            echo "<li><a href=adm/painel.php>Admin</a></li>";
                        }
                    ?>
                    <?php
                    if (isset($_SESSION['logado']))
                        if ($_SESSION['logado'] == false) {
                            echo "<li><a href=login.php>Login</a></li>";
                        }
                    ?>
                    <?php
                    if (isset($_SESSION['logado']))
                        if ($_SESSION['logado'] == true) {
                            echo "<li><a href=logout.php>Logout</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <div id="noticias" class="container">
        <h2>Todas as Notícias</h2>

        <?php
        // Verificar se há notícias
        if (count($menu) > 0) {
            // Se houver notícias, exibe elas
            foreach ($menu as $item) {
                $dataFormatada = date('d/m/Y', strtotime($item['data_cad']));
        ?>
                <div class="noticia">
                    <a href="noticias.php?id=<?php echo $item['id'] ?>" class="">
                        <h2><?php echo $item['titulo']; ?></h2>
                    </a>
                    <div>
                        <p class="descricao-noticias"><?php echo $item['desc']; ?></p>
                        <?php echo "<p class='data'>{$dataFormatada}</p>"; ?>
                    </div>
                </div>
        <?php
            }
        } else {
            // Se não houver notícias, exibe uma mensagem de aviso
            echo "<p>Nenhuma notícia disponível no momento.</p>";
        }
        ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="assets/js/scroll.js"></script>
</body>

</html>