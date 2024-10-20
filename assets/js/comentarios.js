document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('comentario-form');
    const btnVerMais = document.getElementById("ver-mais");

    // Enviar comentário via AJAX
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Previne o comportamento padrão do formulário

            const formData = new FormData(form); // Captura os dados do formulário

            // Envia o comentário via fetch para processa_comentario.php
            fetch('./backend/processa_comentario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Após o comentário ser processado, busca a lista atualizada de comentários
                    carregarComentarios(formData.get('id_noticia'), 0); // Atualiza todos os comentários, sem limite
                    document.querySelector('textarea[name="comentario"]').value = ''; // Limpa o campo de comentário
                } else {
                    console.error('Erro ao enviar comentário:', data.error);
                }
            })
            .catch(error => console.error('Erro:', error));
        });
    }

    // Função para carregar e atualizar os comentários na página
    function carregarComentarios(id_noticia, offset) {
        fetch('./backend/carregar_comentarios.php?id_noticia=' + id_noticia + '&offset=' + offset)
        .then(response => response.text())
        .then(comentarios => {
            if (offset === 0) {
                // Se for o primeiro carregamento, substitui os comentários
                document.getElementById('comentarios-list').innerHTML = comentarios;
            } else {
                // Se for carregamento incremental, adiciona os novos comentários
                document.getElementById('comentarios-list').insertAdjacentHTML('beforeend', comentarios);
            }
        })
        .catch(error => console.error('Erro ao carregar comentários:', error));
    }

    // Botão "Ver mais" para carregar comentários adicionais
    if (btnVerMais) {
        btnVerMais.addEventListener("click", function() {
            const offset = parseInt(btnVerMais.getAttribute("data-offset"));
            const idNoticia = btnVerMais.getAttribute("data-id-noticia");

            // Faz a requisição para carregar mais comentários
            carregarComentarios(idNoticia, offset);

            // Atualiza o offset no botão "Ver mais"
            btnVerMais.setAttribute("data-offset", offset + 3);
        });
    }
});