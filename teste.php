<?php

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $number = $_POST["numero"];
    $satisfacao_geral = $_POST["satisfacao-geral"];
    $consistencia_velocidade = $_POST["consistencia-velocidade"];
    $satisfacao_atendimento = $_POST["satisfacao-atendimento"];
    $melhoria_atendimento = $_POST["melhoria-atendimento"];
    $assistencia_tecnica = $_POST["tecnico-geral"];
    $resolucao_problemas = $_POST["resolucao-problemas"];

    // Endereço de email para onde enviar as respostas
    $destinatario = "joaosocial1704@gmail.com";

    // Assunto do email
    $assunto = "Resposta Pesquisa de Satisfação";

    // Mensagem de email
    $mensagem = "

**Pesquisa de Satisfação**

Nome: $nome
E-mail: $email
Numero: $number

**Satisfação Geral**
$satisfacao_geral

**Consistência da Velocidade**
$consistencia_velocidade

**Satisfação com o Atendimento**
$satisfacao_atendimento

**Melhoria no Atendimento**
$melhoria_atendimento

**Avaliação de assistência técnica**
$assistencia_tecnica

**Resolução de Problemas**
$resolucao_problemas


**Obrigado pela sua participação!**

";

    // Envie o email
    $envio = mail($destinatario, $assunto, $mensagem);

    if ($envio) {
        echo "Resposta enviada com sucesso!";
    } else {
        echo "Erro ao enviar a resposta.";
    }

    // Crie uma conexão com o banco de dados
    $db = new PDO("sqlite:dados.db");

    // Prepare a instrução SQL para inserir os dados
    $sql = "INSERT INTO respostas (nome, email, numero, satisfacao_geral, consistencia_velocidade, satisfacao_atendimento, melhoria_atendimento, assistencia_tecnica, resolucao_problemas) VALUES (:nome, :email, :numero, :satisfacao_geral, :consistencia_velocidade, :satisfacao_atendimento, :melhoria_atendimento, :assistencia_tecnica, :resolucao_problemas)";

    // Prepare os valores para serem inseridos
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":numero", $number);
    $stmt->bindParam(":satisfacao_geral", $satisfacao_geral);
    $stmt->bindParam(":consistencia_velocidade", $consistencia_velocidade);
    $stmt->bindParam(":satisfacao_atendimento", $satisfacao_atendimento);
    $stmt->bindParam(":melhoria_atendimento", $melhoria_atendimento);
    $stmt->bindParam(":assistencia_tecnica", $assistencia_tecnica);
    $stmt->bindParam(":resolucao_problemas", $resolucao_problemas);

    // Execute a instrução SQL
    $stmt->execute();

    // Feche a conexão com o banco de dados
    $db = null;
}

