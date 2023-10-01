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
    $interesses = [];

    if (isset($_POST["auxiliar-administrativo"])) {
        $interesses[] = "Auxiliar Administrativo";
    }
    if (isset($_POST["operador-de-caixa"])) {
        $interesses[] = "Operador de Caixa";
    }
    if (isset($_POST["vendas"])) {
        $interesses[] = "Vendas";
    }
    if (isset($_POST["operador-de-cobranca"])) {
        $interesses[] = "Operador de Cobrança";
    }
    if (isset($_POST["tecnico"])) {
        $interesses[] = "Técnico";
    }

    $interesses_str = implode(", ", $interesses);


    

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
    $mensagem .= "interesse em:  $enterese_tec\n";
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
?>
