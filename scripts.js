function openModal() {
    console.log('Abrindo modal...');
    videoModal.style.display = 'block';
}
document.addEventListener('DOMContentLoaded', function() {
    // Agora o código só será executado após o carregamento completo do DOM
   
    // Seleciona a miniatura do vídeo e o botão de fechar
    const videoThumbnail = document.getElementById('videoThumbnail');
    const videoModal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    const closeModalButton = document.getElementById('closeModal');

    // Função para fechar o modal e parar o vídeo
    function closeModal() {
        console.log('Fechando modal...');
        videoModal.style.display = 'none';
    }

    // Adiciona o evento de clique na miniatura do vídeo
    videoThumbnail.addEventListener('click', openModal);

    // Adiciona o evento de clique no botão de fechar
    closeModalButton.addEventListener('click', closeModal);
});