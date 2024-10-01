// Função para abrir o modal e carregar o vídeo
function abrirModal(midiaUrl, titulo) {
    var modal = document.getElementById("videoModal");
    var iframe = document.getElementById("videoFrame");
    var modalTitulo = document.getElementById("modalTitulo");

    // Definir o título e a URL do vídeo
    modalTitulo.textContent = titulo;
    iframe.src = midiaUrl;

    // Mostrar o modal
    modal.style.display = "block";
}

// Fechar o modal ao clicar no "X"
document.getElementById("closeModal").onclick = function() {
    var modal = document.getElementById("videoModal");
    var iframe = document.getElementById("videoFrame");

    // Limpar a URL do iframe para parar o vídeo
    iframe.src = "";
    modal.style.display = "none";
}

// Fechar o modal ao clicar fora dele
window.onclick = function(event) {
    var modal = document.getElementById("videoModal");
    if (event.target == modal) {
        modal.style.display = "none";
        var iframe = document.getElementById("videoFrame");
        iframe.src = "";
    }
}
