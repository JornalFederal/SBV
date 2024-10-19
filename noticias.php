<?php
session_start();

try {
    include "backend/conexao.php";

    $id = $_GET['id'];

    // comando que sera executado no banco de dados
    $sql = "SELECT * FROM tb_jornal WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $menu = $stmt->fetchAll((PDO::FETCH_ASSOC));
} catch (PDOException $err) {
    echo "Erro" . $err->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP</title>
    <link rel="stylesheet" href="assets/css/pre-style.css">
</head>

<body>
    <header id="header">
        <div class="container">
            <img src="assets/img/logojornal.png" alt="" height="80px">
            <nav>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="todas-noticias.php">Notícias</a></li>
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
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="holder">
            <div class="noticia-container">
                <?php
                foreach ($menu as $item) {
                ?>
                    <div class="noticia-info">
                        <h2 class="news-tit"><?php echo $item['titulo']; ?></h2>
                        <img class="img" src="<?php echo $item['img']; ?>" alt="">
                        <p><?php echo $item['conteudo']; ?></p>
                        <br>
                        <br>
                    </div>
                <?php
                };
                ?>
            </div>
        </div>
    </div>
    <div class="center"><a href="index.php"><button class="voltar-button">Voltar</button></a></div>
    <footer>
        <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
    </footer>

    <script src="assets/js/scroll.js"></script>
</body>

</html>