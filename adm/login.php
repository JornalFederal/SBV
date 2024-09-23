<?php

    $erro = '';
    $email = '';
    $senha = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        try {
            include "../backend/conexao.php";

            $email    = $_POST ['email'];
            $senha    = $_POST ['senha'];
            
                $sql = "SELECT * FROM tb_usuario WHERE email = :email AND senha = SHA2(:senha, 256);";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);

                $stmt->execute();

                $dados = $stmt->fetchAll((PDO::FETCH_ASSOC));

                // echo"<pre>";
                // var_dump($dados);
                // exit;

                if($dados != null){
                    session_start();
                    $_SESSION['id_sistema'] = '_jornal';
                    // var_dump($_SESSION['id_sistema']);
                    $_SESSION['email'] = $email;
                    // var_dump($_SESSION['email']);
                    $_SESSION['id_usuario'] = $dados[0]['id'];

                    header("location: pub_noticia.php");
                }else{
                    $erro="Dados inválidos";
                }

        } catch (PDOException $err) {

            echo "Não foi Possível fazer login".$err->getMessage();

        }  
    } 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <p class="description">
            Jornal do IF-SP
        </p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="showLoader()">
            <div class="form">
                <input type="text" name="email" id="email" placeholder="Usuário" value='<?php echo $email; ?>' required>
                <input type="password"  name="senha" id="senha" placeholder="Senha" required>
                <?php echo "<p class='erro'>".$erro."</p>" ?>
                <div class="buttons">
                    <a href="principal.php">
                        <button type="submit" class="entrar">Entrar</button>
                    </a>
                </div>
                <!-- New link for password recovery -->
                <a href="recuperar.php" class="recuperar-senha">Recuperar Senha</a>
            </div>
        </form>
    </div>
    <script>
        function showLoader() {
            document.getElementById('loader').style.display = 'block';
        }
    </script>
</body>
</html>