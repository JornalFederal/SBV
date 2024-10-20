<?php
session_start();

try {
    include "conexao.php";

    $id_noticia = $_POST['id_noticia'];
    $comentario = $_POST['comentario'];
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "INSERT INTO comentarios (id_noticia, id_usuario, comentario, data_comentario) VALUES (:id_noticia, :id_usuario, :comentario, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_noticia', $id_noticia);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':comentario', $comentario);
    $stmt->execute();

    // Retorna sucesso
    echo json_encode(['success' => true]);
    exit();

} catch (PDOException $err) {
    echo json_encode(['success' => false, 'error' => $err->getMessage()]);
    exit();
}
?>