<?php
 
session_start();

  try {
   
    include "backend/conexao.php";
 
    $sql = "SELECT * FROM tb_jornal ORDER BY data_cad DESC LIMIT 3;";
 
    $stmt = $conn->prepare($sql);
 
    $stmt->execute();

    $menu = $stmt->fetchAll((PDO::FETCH_ASSOC));

   
   
 
  }catch(PDOException $err){
    echo "Erro".$err->getMessage();
  }
 
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jornal Estudantil IFSP SBV</title>
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
    <section id="noticias" class="container">
        <h2>Últimas Notícias</h2>
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
        <div class="news-item">
            <div class="news-video">
                <!-- Miniatura do vídeo (use uma imagem estática ou thumbnail do vídeo) -->
                <img src="" onerror="this.src='assets/img/jorge.png';" alt="Imagem do vídeo" class="thumbnail" id="videoThumbnail" >
                <span class="video-duration">3 min</span>
            </div>
            <div class="news-content">
                <h2 id="arrumar">Viagem a China e Novas Visões</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi delectus veritatis laudantium labore tenetur ex amet expedita ea libero ad, pariatur dolore voluptatibus, nihil reiciendis cumque, tempore eligendi modi atque.</p></div>
        </div>
         <!-- Modal para exibição do vídeo -->
         <div id="videoModal" class="modal">
            <div class="modal-content">
                <h2 class="news-video-title">Lorem Ipsum</h2>
                <span class="close" id="closeModal">&times;</span>
                <iframe id="videoFrame" src="https://www.youtube.com/embed/LXb3EKWsInQ?controls=1&modestbranding=0&rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <section id="eventos" class="container">
        <h2>Próximos Eventos</h2>
        <ul>
            <li>10/09 - Palestra: Inovações Tecnológicas</li>
            <li>12/09 - Workshop: Programação para Iniciantes</li>
            <li>14/09 - Feira de Ciências</li>
        </ul>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="assets/js/scripts.js"></script>
</body>
</html>