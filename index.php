<?php
// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $numero = $_POST["numero"];
    $velocidade = $_POST["velocidade"];
    $atendimento = $_POST["atendimento"];
    $estabilidade = $_POST["estabilidade"];
    $resolucao_problemas = $_POST["resolucao-problemas"];
    $sugestoes = $_POST["sugestoes"];
    
    // Endereço de email para onde enviar as respostas
    $destinatario = "joaosocial1704@gmail.com";
    
    // Assunto do email
    $assunto = "Resposta Pesquisa de Satisfação  de $nome";
    
    // Mensagem de email
    $mensagem = "Nome: $nome\n";
    $mensagem .= "Email: $email\n";
    $mensagem .= "Número: $numero\n";
    $mensagem .= "Velocidade: $velocidade\n";
    $mensagem .= "Atendimento: $atendimento\n";
    $mensagem .= "Estabilidade: $estabilidade\n";
    $mensagem .= "Resolução de Problemas: $resolucao_problemas\n";
    $mensagem .= "Sugestões/Comentários:\n$sugestoes\n";

    // Envie o email
    $envio = mail($destinatario, $assunto, $mensagem);

    if ($envio) {
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar a resposta.";
    }
}
?>
