<?php
session_start();
include 'conexao.php'; // Verifique se o caminho está correto

$id_noticia = $_GET['id_noticia'];
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Se não houver offset, o padrão será 0

$sql = "SELECT c.comentario, c.data_comentario, u.nome 
        FROM comentarios c 
        JOIN usuarios u ON c.id_usuario = u.id 
        WHERE c.id_noticia = :id_noticia 
        ORDER BY c.data_comentario DESC 
        LIMIT 3 OFFSET :offset";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_noticia', $id_noticia);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($comentarios as $comentario) {
    // Formata a data para o formato desejado
    $data_formatada = date('d/m/Y H:i', strtotime($comentario['data_comentario']));
    echo "<div class='comentario'>";
    echo "<strong class='username'>" . htmlspecialchars($comentario['nome']) . " </strong><small>" . $data_formatada . "</small>";
    echo "<p class='comentario'>" . htmlspecialchars($comentario['comentario']) . "</p>";
    echo "<hr>";
    echo "</div>"; 
}
