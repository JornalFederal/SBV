<?php
$noticias = [
    1 => [
        "titulo" => "Inauguração da Nova Biblioteca",
        "data" => "01 de setembro de 2024",
        "conteudo" => "Detalhes sobre a inauguração da nova biblioteca."
    ],
    2 => [
        "titulo" => "Semana Acadêmica: Um Sucesso",
        "data" => "28 de agosto de 2024",
        "conteudo" => "Detalhes sobre a semana acadêmica."
    ],
    // Adicione mais notícias conforme necessário
];

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$noticia = isset($noticias[$id]) ? $noticias[$id] : $noticias[1];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $noticia['titulo']; ?> - Jornal Estudantil IFSP SBV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include('header.php'); ?>

    <section class="container">
        <h2><?php echo $noticia['titulo']; ?></h2>
        <p><strong><?php echo $noticia['data']; ?></strong></p>
        <p><?php echo $noticia['conteudo']; ?></p>
        <a href="todas-noticias.php" class="button">Voltar para Todas as Notícias</a>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>
