<?php
session_start();
include 'conexao.php'; // Verifique se o caminho está correto

$id_noticia = $_GET['id_noticia'];
$offset = $_GET['offset'];

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
    echo "<div class='comentario'>";
    echo "<strong>" . htmlspecialchars($comentario['nome']) . " disse:</strong>";
    echo "<p>" . htmlspecialchars($comentario['comentario']) . "</p>";
    echo "<small>" . $comentario['data_comentario'] . "</small>";
    echo "<hr>";
    echo "</div>";
}
