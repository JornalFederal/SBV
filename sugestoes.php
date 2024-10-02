<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "backend/conexao.php";

    $nome = $_POST['nome'];
    $sugestao = $_POST['sugestao'];

    try {
        // Inserir sugestão no banco de dados
        $sql = "INSERT INTO tb_sugestoes (nome, sugestao) VALUES (:nome, :sugestao)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sugestao', $sugestao);
        $stmt->execute();

        echo json_encode(['mensagem' => "Sugestão enviada com sucesso!"]); // Envia uma resposta JSON
    } catch(PDOException $e) {
        echo json_encode(['mensagem' => "Erro ao enviar sugestão: " . $e->getMessage()]); // Resposta de erro em JSON
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa de Sugestões - Jornal Estudantil IFSP SBV</title>
    <link rel="stylesheet" href="assets/css/modal.css">
</head>
<body>
    <header id="header">
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
    <section class="container">
        <h2>Caixa de Sugestões</h2>
        <p>Quer compartilhar suas ideias ou dar sugestões para melhorar o nosso jornal? Preencha o formulário abaixo e nos envie sua sugestão! Caso queira ser Anônimo é só deixar o nome padrão!</p>
        <form id="sugestaoForm">
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

