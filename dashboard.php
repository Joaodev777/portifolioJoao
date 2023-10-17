// <?php
// // Conexão com o banco de dados (substitua pelos seus próprios detalhes)
// $db = new SQLite3('dados.db');

// // Consulta para obter os dados da pesquisa
// $query = "SELECT satisfacao_geral, consistencia_velocidade, resolucao_problemas FROM respostas";
// $result = $db->query($query);

// // Inicialize arrays para armazenar os dados
// $satisfacaoGeralData = [];
// $consistenciaVelocidadeData = [];
// $resolucaoProblemasData = [];

// while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
//     $satisfacaoGeralData[] = $row['satisfacao_geral'];
//     $consistenciaVelocidadeData[] = $row['consistencia_velocidade'];
//     $resolucaoProblemasData[] = $row['resolucao_problemas'];
// }

// // Feche a conexão com o banco de dados
// $db->close();

// // Converta os arrays em JSON para enviar à página HTML
// $data = [
//     'satisfacaoGeral' => $satisfacaoGeralData,
//     'consistenciaVelocidade' => $consistenciaVelocidadeData,
//     'resolucaoProblemas' => $resolucaoProblemasData,
// ];

// echo json_encode($data);
// ?>

<?php
// Crie um banco de dados SQLite
$db = new SQLite3('dados.db');

// Crie uma tabela para armazenar os dados da pesquisa
$db->exec('CREATE TABLE IF NOT EXISTS pesquisa (
    id INTEGER PRIMARY KEY,
    nome TEXT,
    satisfacao_geral INTEGER,
    consistencia_velocidade INTEGER,
    satisfacao_atendimento INTEGER,
    melhoria_atendimento TEXT,
    assistencia_tecnica INTEGER,
    resolucao_problemas INTEGER
)');

// Insira dados de exemplo na tabela (você pode substituir por dados reais)
$db->exec("INSERT INTO pesquisa (nome, satisfacao_geral, consistencia_velocidade, satisfacao_atendimento, melhoria_atendimento, assistencia_tecnica, resolucao_problemas)
VALUES
('Cliente A', 4, 3, 5, 'Mais suporte telefônico', 4, 5),
('Cliente B', 5, 4, 4, 'Melhorias no site', 5, 5),
('Cliente C', 3, 2, 4, 'Nenhum', 3, 2)");

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
    // Recupere os dados do banco de dados SQLite
    $db = new SQLite3('pesquisa.db');
    $result = $db->query("SELECT * FROM pesquisa");
    $data = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $data[] = $row;
    }
    $db->close();
    ?>
teste

    <!-- Aqui você pode usar os dados para criar gráficos em PHP ou JavaScript -->
</body>
</html>
