<?php
session_start();

try {
    include "backend/conexao.php";
} catch (PDOException $err) {
    echo "Erro: " . $err->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa de Sugestões - Jornal Estudantil IFSP SBV</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                    <li><a href="sugestoes.php" class="active">Sugestões</a></li>
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
    <section class="container">
        <h2>Caixa de Sugestões</h2>
        <p>Quer compartilhar suas ideias ou dar sugestões para melhorar o nosso jornal? Preencha o formulário abaixo e nos envie sua sugestão! Caso queira ser Anônimo é só deixar o nome padrão!</p>
        <form class="form" id="sugestaoForm">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" value="Anônimo" placeholder="Seu Nome" required><br><br>

            <label for="sugestao">Sugestão:</label><br>
            <textarea id="sugestao" name="sugestao" rows="4" placeholder="Sua Sugestão Aqui!" required></textarea><br><br>

            <button type="submit">Enviar Sugestão</button>
        </form>
    </section>
    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="assets/js/sugestoes.js"></script>
    <script src="assets/js/scroll.js"></script>
</body>

</html>