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
// Inclua a biblioteca pChart
require_once("pChart2.1.4/class/pData.class.php");
require_once("pChart2.1.4/class/pDraw.class.php");
require_once("pChart2.1.4/class/pPie.class.php");
require_once("pChart2.1.4/class/pLine.class.php");

// Dados de exemplo para os gráficos
$data = array(
    "Satisfeito" => 60,
    "Insatisfeito" => 40
);

$lineData = array(3, 5, 4, 2, 6);

$areaData = array(10, 20, 15, 30, 25);

// Gráfico de Pizza
$PieChart = new pPie(400, 250);
$PieChart->addData($data);
$PieChart->setLabel(array_keys($data));
$PieChart->draw2DPie(200, 125, array("WriteValues" => TRUE, "DataGapAngle" => 10, "DataGapRadius" => 6));

$PieChart->Render("grafico_pizza.png");

// Gráfico de Linha
$LineChart = new pImage(400, 250);
$LineChart->setFontProperties(array("FontName" => "pChart2.1.4/fonts/verdana.ttf", "FontSize" => 8));
$LineChart->setGraphArea(50, 30, 350, 200);
$LineChart->drawScale();
$LineChart->drawLineChart(array("DisplayValues" => TRUE, "DisplayColor" => DISPLAY_AUTO), $lineData);
$LineChart->Render("grafico_linha.png");

// Gráfico de Área
$AreaChart = new pImage(400, 250);
$AreaChart->setFontProperties(array("FontName" => "pChart2.1.4/fonts/verdana.ttf", "FontSize" => 8));
$AreaChart->setGraphArea(50, 30, 350, 200);
$AreaChart->drawScale();
$AreaChart->drawAreaChart(array("DisplayValues" => TRUE, "DisplayColor" => DISPLAY_AUTO), $areaData);
$AreaChart->Render("grafico_area.png");

// Exiba os gráficos
echo '<img src="grafico_pizza.png" alt="Gráfico de Pizza">';
echo '<img src="grafico_linha.png" alt="Gráfico de Linha">';
echo '<img src="grafico_area.png" alt="Gráfico de Área">';
?>



