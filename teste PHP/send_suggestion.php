<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $sugestao = htmlspecialchars($_POST['sugestao']);

    // Destinatário
    $to = "seuemail@ifsp.edu.br";  // Substitua com seu e-mail
    $subject = "Nova Sugestão do Jornal Estudantil";

    // Corpo do e-mail
    $message = "
        <html>
        <head>
        <title>Sugestão do Jornal</title>
        </head>
        <body>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>Sugestão:</strong> $sugestao</p>
        </body>
        </html>
    ";

    // Cabeçalhos para envio no formato HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <' . $email . '>' . "\r\n";

    // Envia o e-mail
    if (mail($to, $subject, $message, $headers)) {
        // Redireciona para a página de sugestões com mensagem de sucesso
        header("Location: sugestoes.php?status=success");
    } else {
        echo "Ocorreu um erro ao enviar sua sugestão.";
    }
}
?>
