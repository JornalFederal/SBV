<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugestões - Jornal Estudantil IFSP SBV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include('header.php'); ?>

    <section class="container">
        <h2>Caixa de Sugestões</h2>
        <p>Deixe suas sugestões para melhorar o nosso jornal!</p>

        <form action="send_suggestion.php" method="POST">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="sugestao">Sugestão:</label><br>
            <textarea id="sugestao" name="sugestao" rows="4" required></textarea><br><br>

            <button type="submit">Enviar Sugestão</button>
        </form>

        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo '<p style="color: green;">Obrigado pela sua sugestão!</p>';
        }
        ?>

    </section>

    <?php include('footer.php'); ?>

</body>
</html>
