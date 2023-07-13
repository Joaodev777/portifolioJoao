<?php
// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Obtém os dados do formulário
    $data = $_POST['data'];
    $empresa = $_POST['empresa'];
    $motivo = $_POST['motivo'];
    $email = $_POST['email'];

    // Obtém a hora atual
    $horaAtual = date('H:i');

    // Define a hora em que o e-mail será enviado
    $horaEnvio = $horaAtual; // Enviar no mesmo horário

    // Verifica se a hora atual é igual à hora de envio
    if ($horaAtual === $horaEnvio) {
        // Define as informações do e-mail
        $para = $email;
        $assunto = 'Lembrete do evento';
        $mensagem = "Olá,\n\nEste é um lembrete do evento que acontecerá hoje.\n\nDetalhes do evento:\nData: $data\nEmpresa: $empresa\nMotivo: $motivo\n\n";

        // Envia o e-mail
        if (mail($para, $assunto, $mensagem)) {
            echo "E-mail enviado com sucesso para $email";
        } else {
            echo "Falha ao enviar o e-mail";
        }
    } else {
        echo "Não é a hora de envio do e-mail";
    }
}
?>
