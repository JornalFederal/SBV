document.getElementById('sugestaoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio normal do formulário

    var formData = new FormData(this);

    // Envia o formulário via AJAX
    fetch('sugestoes.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Exibe a mensagem de sucesso ou erro
        alert(data.mensagem);
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});