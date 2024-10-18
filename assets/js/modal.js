// Função para abrir o modal e carregar o vídeo
function abrirModal(midiaUrl, titulo, conteudo) {
  var modal = document.getElementById("videoModal");
  var iframe = document.getElementById("videoFrame");
  var modalTitulo = document.getElementById("modalTitulo");
  var modalConteudo = document.getElementById("modalConteudo"); // Novo elemento para o conteúdo

  // Definir o título, a URL do vídeo e o conteúdo
  modalTitulo.textContent = titulo;
  iframe.src = midiaUrl;
  modalConteudo.textContent = conteudo; // Define o conteúdo do modal

  // Adicionar a classe modal-open ao body
  document.body.classList.add("modal-open");

  // Mostrar o modal
  modal.style.display = "block";
}

// Fechar o modal ao clicar no "X"
document.getElementById("closeModal").onclick = function () {
  var modal = document.getElementById("videoModal");
  var iframe = document.getElementById("videoFrame");

  // Limpar a URL do iframe para parar o vídeo
  iframe.src = "";
  modal.style.display = "none";

  // Remover a classe modal-open do body
  document.body.classList.remove("modal-open");
};

// Fechar o modal ao clicar fora dele
window.onclick = function (event) {
  var modal = document.getElementById("videoModal");
  if (event.target == modal) {
    modal.style.display = "none";
    var iframe = document.getElementById("videoFrame");
    iframe.src = "";

    // Remover a classe modal-open do body
    document.body.classList.remove("modal-open");
  }
};
