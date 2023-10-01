<?php

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $numero = $_POST["numero"];
    $idade = $_POST["idade"];
    $sobre_a_pessoa = $_POST["sobre-a-pessoa"];
    $curso_livro = $_POST["curso-livro"];
    $ponto_fraco = $_POST["ponto-fraco"];
    $motivo_saida_emprego = $_POST["motivo-saida-emprego"];
    $interesse_vaga = $_POST["interesse-vaga"];
    $qualidades = $_POST["qualidades"];
    $porque_contratar = $_POST["porque-contratar"];
    $onde_em_cinco_anos = $_POST["onde-em-cinco-anos"];
    $pressao = $_POST["pressao"];
    $trabalho_em_equipe = $_POST["trabalho-em-equipe"];
    $realizacao_profissional = $_POST["realizacao-profissional"];
    $experiencias = $_POST["experiencias"];

    // Endereço de email para onde enviar as respostas
    $destinatario = "vagasdisponiveis414@gmail.com";

    // Assunto do email
    $assunto = "Resposta Formulario de contrato";

    
    // Mensagem de email
    $mensagem = "Nome: $nome\n\n";
    $mensagem .= "E-mail: $email\n\n";
    $mensagem .= "Número: $numero\n\n";
    $mensagem .= "Idade: $idade\n\n";
    $mensagem .= "Sobre a pessoa: $sobre_a_pessoa\n\n";
    $mensagem .= "Curso ou livro: $curso_livro\n\n";
    $mensagem .= "Pontos fracos: $ponto_fraco\n\n";
    $mensagem .= "Motivo saída emprego anterior: $motivo_saida_emprego\n\n";
    $mensagem .= "Interesse na vaga: $interesse_vaga\n\n";
    $mensagem .= "Principais qualidades: $qualidades\n\n";
    $mensagem .= "Por que contratar: $porque_contratar\n\n";
    $mensagem .= "Onde estar em cinco anos: $onde_em_cinco_anos\n\n";
    $mensagem .= "Lida com pressão: $pressao\n\n";
    $mensagem .= "Trabalho em equipe: $trabalho_em_equipe\n\n";
    $mensagem .= "Realização profissional: $realizacao_profissional\n\n";
    $mensagem .= "Experiências anteriores: $experiencias\n\n";



    

    // Envie o email
    $envio = mail($destinatario, $assunto, $mensagem);

    if ($envio) {
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar a resposta.";
    }
}
