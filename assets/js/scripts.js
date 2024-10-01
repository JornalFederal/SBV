document.addEventListener('DOMContentLoaded', function() {
    const videoThumbnail = document.querySelector('.video-thumbnail');
    const videoModal = document.getElementById('videoModal');
    const videoFrame = document.getElementById('videoFrame');
    const closeModal = document.getElementById('closeModal');

    if (videoThumbnail) {
        videoThumbnail.addEventListener('click', function() {
            const videoUrl = "<?php echo $noticiaComVideo['midia']; ?>"; // Pega a URL do vídeo do PHP
            videoFrame.src = videoUrl; // Define a URL no iframe
            videoModal.style.display = 'block'; // Mostra o modal
        });
    }

    closeModal.addEventListener('click', function() {
        videoModal.style.display = 'none'; // Esconde o modal
        videoFrame.src = ''; // Limpa a URL do iframe
    });

    window.addEventListener('click', function(event) {
        if (event.target === videoModal) {
            videoModal.style.display = 'none'; // Esconde o modal ao clicar fora
            videoFrame.src = ''; // Limpa a URL do iframe
        }
    });
});
