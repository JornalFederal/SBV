<?php

session_start();

try {
    include "backend/conexao.php";

    // comando que sera executado no banco de dados
    // Selecionar todas as notícias e ordenar por ID em ordem decrescente
    $sql = "SELECT * FROM tb_jornal ORDER BY id DESC";
 
    $stmt = $conn->prepare($sql);
 
    $stmt->execute();

    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $err) {
    echo "Erro: " . $err->getMessage();
}

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP</title>
    <link rel="stylesheet" href="assets/css/modal.css">
</head>
<body>
    <header>
        <h1>Jornal Estudantil IFSP São João da Boa Vista</h1>
        <div class="container">
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
    <div class="container">
    <?php
                foreach($menu as $item){
            $dataFormatada = date('d/m/Y', strtotime($item['data_cad']))
            ?>
            <div class="noticia">
            <a href="noticias.php?id=<?php echo $item['id']?>" class="">
                <h2><?php echo $item['titulo']; ?></h2>
            </a>
                <div>
                    <p class="descricao-noticias"><?php echo $item['desc']; ?></p>
                    <?php echo "<p class='data'>{$dataFormatada}</p>"; ?>
                </div>
            </div>
            <?php
            };?>
    </div>
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
