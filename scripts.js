// Precisa de Servidor e PHP para funcionar.
document.getElementById('sugestaoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio do formulário
    // Limpa o formulário
    document.getElementById('sugestaoForm').reset();
});
