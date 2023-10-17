<?php
// Conexão com o banco de dados (substitua pelos seus próprios detalhes)
$db = new SQLite3('dados.db');

// Consulta para obter os dados da pesquisa
$query = "SELECT satisfacao_geral, consistencia_velocidade, resolucao_problemas FROM respostas";
$result = $db->query($query);

// Inicialize arrays para armazenar os dados
$satisfacaoGeralData = [];
$consistenciaVelocidadeData = [];
$resolucaoProblemasData = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $satisfacaoGeralData[] = $row['satisfacao_geral'];
    $consistenciaVelocidadeData[] = $row['consistencia_velocidade'];
    $resolucaoProblemasData[] = $row['resolucao_problemas'];
}

// Feche a conexão com o banco de dados
$db->close();

// Converta os arrays em JSON para enviar à página HTML
$data = [
    'satisfacaoGeral' => $satisfacaoGeralData,
    'consistenciaVelocidade' => $consistenciaVelocidadeData,
    'resolucaoProblemas' => $resolucaoProblemasData,
];

echo json_encode($data);
?>
