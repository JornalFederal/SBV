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

    // Redirecionar de volta para a página da notícia
    header("Location: ../noticias.php?id=" . $id_noticia);
    exit();

} catch (PDOException $err) {
    echo "Erro: " . $err->getMessage();
}
?>