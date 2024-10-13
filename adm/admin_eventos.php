<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

require_once("../backend/conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos
    $titulo = $_POST['titulo'] ?? NULL;
    $data_evento = $_POST['data_evento'] ?? NULL;
    $descricao = $_POST['descricao'] ?? NULL;

    // Verificar se os campos obrigatórios estão preenchidos
    if (!empty($titulo) && !empty($data_evento)) {
        // Inserir no banco de dados
        $stmt = $conn->prepare("INSERT INTO eventos (titulo, data_evento, descricao) VALUES (:titulo, :data_evento, :descricao)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':data_evento', $data_evento);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            $mensagem = "Evento adicionado com sucesso!";
        } else {
            $mensagem = "Erro ao adicionar o evento.";
        }
    } else {
        // Mensagem de erro caso algum campo esteja vazio
        $mensagem = "Preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Eventos</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Área Restrita - Jornal Federal</h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Site Principal</a></li>
                    <li><a href="adicionar_noticia.php">Adicionar Notícias</a></li>
                    <li><a href="deletar_noticia.php">Deletar Notícias</a></li>
                    <li><a href="admin_sugestoes.php">Ver Sugestões</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="container">
        <h2>Adicionar Novo Evento</h2>
        <form method="POST" action="" class="forms">
            <label for="evento">Nome do Evento:</label>
            <input type="text" name="evento" id="evento" required>
            <label for="data_evento">Data do Evento:</label>
            <input type="date" name="data_evento" id="data_evento" required>
            <button type="submit" name="add_evento">Adicionar Evento</button>
        </form>
    </section>

    <section class="container">
        <h2>Eventos Cadastrados</h2>
        <?php if (!empty($eventos)): ?>
            <ul>
                <?php foreach ($eventos as $evento): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($evento['evento'] ?? 'Evento sem nome'); ?></strong><br>
                        <?php echo date('d/m/Y', strtotime($evento['data_evento'] ?? '')); ?><br>
                        
                        <!-- Formulário para deletar o evento -->
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="id_evento" value="<?php echo $evento['id']; ?>">
                            <button type="submit" name="delete_evento" onclick="return confirm('Tem certeza que deseja deletar este evento?');">Deletar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum evento cadastrado.</p>
        <?php endif; ?>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Jornal Estudantil IFSP São João da Boa Vista. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>