<?php

session_start();

  try {
   
    include "backend/conexao.php";

    // comando que sera executado no banco de dados
    $sql = "SELECT * FROM tb_jornal";
 
    $stmt = $conn->prepare($sql);
 
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
        <h1>Jornal Estudantil IFSP São João da Boa Vista</h1>
<<<<<<< HEAD
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
=======
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="todas-noticias.php">Notícias</a></li>
                <li><a href="index.php #eventos">Eventos</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="sugestoes.php">Sugestões</a></li>
            </ul>
        </nav>
>>>>>>> b138985621ccf1c5e5cb7325beea699f11fe5e5a
    </header>
    <div class="container">
    <?php
                foreach($menu as $item){
            ?>
            <div class="noticia">
<<<<<<< HEAD
            <a href="noticias.php?id=<?php echo $item['id']?>" class="">
                <h2><?php echo $item['titulo']; ?></h2>
            </a>
                <p><?php echo $item['desc']; ?></p>
=======
            <a href="noticias.php?id=<?php echo $item['id']?>" class="btn btn-home mb-2">
                <h2><?php echo $item['titulo']; ?></h2>
                <p><?php echo $item['desc']; ?></p>
            </a>
>>>>>>> b138985621ccf1c5e5cb7325beea699f11fe5e5a
            </div>
            <?php
            };?>
    </div>
<<<<<<< HEAD
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
=======
>>>>>>> b138985621ccf1c5e5cb7325beea699f11fe5e5a
</body>
</html>
