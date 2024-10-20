<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="assets/css/pre-style.css">
</head>

<body>
    <header id="header">
        <div class="container">
            <img src="assets/img/logojornal.png" alt="Logo Jornal" height="80px">
        </div>
    </header>

    <section class="container">
        <div>
            <h3 style="color: #00510f; text-align: center; margin: 20px 0; font-size: 40px;">Cadastro de Usuário</h3>
            
            <?php
            // Exibe a mensagem de erro, se houver
            if (isset($_SESSION['erro_cadastro'])) {
                echo '<p style="color: red; text-align: center;">' . $_SESSION['erro_cadastro'] . '</p>';
                unset($_SESSION['erro_cadastro']); // Remove a mensagem de erro da sessão
            }
            ?>

            <form class="forms" action="./backend/processa_cadastro.php" method="POST">
                <label for="usuario">Nome de Usuário:</label>
                <input class="login-input" type="text" name="usuario" id="usuario" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input class="login-input" type="password" name="senha" id="senha" required>
                <br><br>
                <button type="submit">Cadastrar</button>
            </form>

            <p style="text-align: center;">Já tem uma conta? <a style="color: #00510f;" href="login.php">Faça login aqui</a></p>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script src="assets/js/scroll.js"></script>
</body>

</html>