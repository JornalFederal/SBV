<script>
        let offset = 5;

        function carregarMaisComentarios() {
            const id_noticia = <?php echo $id; ?>;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'backend/carregar_comentarios.php?id_noticia=' + id_noticia + '&offset=' + offset, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    document.getElementById('comentarios-list').innerHTML += response;
                    offset += 3;

                    // Se não houver mais comentários a serem carregados, ocultar o botão
                    if (offset >= <?php echo $total_comentarios; ?>) {
                        document.getElementById('ver-mais').style.display = 'none';
                    }
                }
            };
            xhr.send();
        }
    </script>