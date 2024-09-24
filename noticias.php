<?php

session_start();

  try {
   
    include "backend/conexao.php";

    $id = $_GET['id'];

    // comando que sera executado no banco de dados
    $sql = "SELECT * FROM tb_jornal WHERE id=:id";
 
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id',$id);
 
    $stmt->execute();

    $menu = $stmt->fetchAll((PDO::FETCH_ASSOC));

   
   
 
  }catch(PDOException $err){
    echo "Erro".$err->getMessage();
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
     <div class="container">
            <h1>Jornal Estudantil IFSP São João da Boa Vista</h1>
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
    <div class="noticia-container">
    <?php
        foreach($menu as $item){
        ?>
            <div class="noticia-info">
                <h2><?php echo $item['titulo']; ?></h2>
                <p><?php echo $item['conteudo']; ?></p>
                <br>
                <br>
                <div class="center"><a href="index.php"><button class="voltar-button">Voltar</button></a></div>
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
