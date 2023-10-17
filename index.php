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

    // Crie um arquivo de banco de dados SQLite
    $db = new SQLite3('respostas_pesquisa.db');

    // Crie a tabela se ela não existir
    $db->exec('CREATE TABLE IF NOT EXISTS respostas (
        nome TEXT,
        email TEXT,
        numero INTEGER,
        satisfacao_geral TEXT,
        consistencia_velocidade TEXT,
        satisfacao_atendimento TEXT,
        melhoria_atendimento TEXT,
        assistencia_tecnica TEXT,
        resolucao_problemas TEXT
    )');

    // Insira os dados na tabela
    $stmt = $db->prepare('INSERT INTO respostas (nome, email, numero, satisfacao_geral, consistencia_velocidade, satisfacao_atendimento, melhoria_atendimento, assistencia_tecnica, resolucao_problemas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bindValue(1, $nome, SQLITE3_TEXT);
    $stmt->bindValue(2, $email, SQLITE3_TEXT);
    $stmt->bindValue(3, $number, SQLITE3_INTEGER);
    $stmt->bindValue(4, $satisfacao_geral, SQLITE3_TEXT);
    $stmt->bindValue(5, $consistencia_velocidade, SQLITE3_TEXT);
    $stmt->bindValue(6, $satisfacao_atendimento, SQLITE3_TEXT);
    $stmt->bindValue(7, $melhoria_atendimento, SQLITE3_TEXT);
    $stmt->bindValue(8, $assistencia_tecnica, SQLITE3_TEXT);
    $stmt->bindValue(9, $resolucao_problemas, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "Resposta enviada com sucesso e armazenada no banco de dados!";
    } else {
        echo "Erro ao enviar a resposta e armazenar no banco de dados.";
    }

    // Feche o banco de dados
    $db->close();
}
?>
