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
    $enterese_vendas = $_POST["vendas"];
    $enterese_caixa = $_POST["operador-de-caixa"];
    $enterese_cobranca = $_POST["operador-de-cobranca"];
    $enterese_administrativo = $_POST["auxiliar-administrativo"];


    // Endereço de email para onde enviar as respostas
    $destinatario = "vagasdisponiveis414@gmail.com";

    // Assunto do email
    $assunto = "Resposta Pesquisa de Satisfação";

    // Mensagem de email
    $mensagem = "Nome: $nome\n";
    $mensagem .= "E-mail: $email\n";
    $mensagem .= "Número: $numero\n";
    $mensagem .= "Idade: $idade\n";
    $mensagem .= "interesse em:  $enterese_administrativo\n";
    $mensagem .= "interesse em:  $enterese_caixa\n";
    $mensagem .= "interesse em:  $enterese_vendas\n";
    $mensagem .= "interesse em:  $enterese_cobranca\n";
    $mensagem .= "Sobre a pessoa: $sobre_a_pessoa\n";
    $mensagem .= "Curso ou livro: $curso_livro\n";
    $mensagem .= "Pontos fracos: $ponto_fraco\n";
    $mensagem .= "Motivo saída emprego anterior: $motivo_saida_emprego\n";
    $mensagem .= "Interesse na vaga: $interesse_vaga\n";
    $mensagem .= "Principais qualidades: $qualidades\n";
    $mensagem .= "Por que contratar: $porque_contratar\n";
    $mensagem .= "Onde estar em cinco anos: $onde_em_cinco_anos\n";
    $mensagem .= "Lida com pressão: $pressao\n";
    $mensagem .= "Trabalho em equipe: $trabalho_em_equipe\n";
    $mensagem .= "Realização profissional: $realizacao_profissional\n";
    $mensagem .= "Experiências anteriores: $experiencias\n";

    // Envie o email
    $envio = mail($destinatario, $assunto, $mensagem);

    if ($envio) {
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar a resposta.";
    }

}
