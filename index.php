<?php
// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário

    $nome = &$_POST["nome"];
    $email = &$_POST["email"];
    $number = &$_POST["numero"];
    $satisfacao_geral = $_POST["satisfacao-geral"];
    $consistencia_velocidade = $_POST["consistencia-velocidade"];
    $satisfacao_atendimento = $_POST["satisfacao-atendimento"];
    $melhoria_atendimento = $_POST["melhoria-atendimento"];
    $assistencia_tecnica = $_POST["tecnico-geral"];
    $resolucao_problemas = $_POST["resolucao-problemas"];

    // Resto do seu código permanece o mesmo

    // Endereço de email para onde enviar as respostas
    $destinatario ="joaosocial1704@gmail.com";


    // Assunto do email
    $assunto = "Resposta Pesquisa de Satisfação";

    // Mensagem de email
    $mensagem .= "Nome: $nome\n";
    $mensagem .= "E-mail: $email\n";
    $mensagem .= "Numero: $number\n";
    $mensagem .= "Satisfação Geral: $satisfacao_geral\n";
    $mensagem .= "Consistência da Velocidade: $consistencia_velocidade\n";
    $mensagem .= "Satisfação com o Atendimento: $satisfacao_atendimento\n";
    $mensagem .= "Melhoria no Atendimento: $melhoria_atendimento\n";
    $mensagem .= "Avaliação de assistencia tecnica: $assistencia_tecnica\n";
    $mensagem .= "Resolução de Problemas: $resolucao_problemas\n";

    // Envie o email
    $envio = mail($destinatario, $assunto, $mensagem);


    if ($envio) {
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar a resposta.";
    }


}
?>
