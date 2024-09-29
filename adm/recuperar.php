<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <p class="description">
            Jornal do IF-SP
        </p> 
        <form id="emailForm" action="backend/recuperar.php" class="form-recuperar-senha" method='POST'>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>
            
            <button type="submit">Recuperar Senha</button>
        </form>
        <div class="links">
            <a href="login.php" class="voltar">Voltar</a>
        </div>
    </div>
</body>
</html>