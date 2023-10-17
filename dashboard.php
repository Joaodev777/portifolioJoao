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
// Dados de exemplo para os gráficos
$data = [
    "Satisfeito" => 60,
    "Insatisfeito" => 40
];

$lineData = [3, 5, 4, 2, 6];

$areaData = [10, 20, 15, 30, 25];

// Crie um gráfico de pizza
$width = 400;
$height = 250;
$pieChart = imagecreatetruecolor($width, $height);

$backgroundColor = imagecolorallocate($pieChart, 255, 255, 255);
imagefill($pieChart, 0, 0, $backgroundColor);

$colors = [imagecolorallocate($pieChart, 0, 128, 0), imagecolorallocate($pieChart, 255, 0, 0)];

$startAngle = 0;
foreach ($data as $label => $value) {
    $endAngle = $startAngle + (360 * $value / 100);
    imagefilledarc($pieChart, $width / 2, $height / 2, $width, $height, $startAngle, $endAngle, $colors[$startAngle], IMG_ARC_PIE);
    $startAngle = $endAngle;
}

// Crie um gráfico de linha
$lineChart = imagecreatetruecolor($width, $height);
$backgroundColor = imagecolorallocate($lineChart, 255, 255, 255);
imagefill($lineChart, 0, 0, $backgroundColor);
$lineColor = imagecolorallocate($lineChart, 0, 0, 255);

$minValue = min($lineData);
$maxValue = max($lineData);
$numPoints = count($lineData);
$intervalX = $width / ($numPoints - 1);

for ($i = 1; $i < $numPoints; $i++) {
    $x1 = ($i - 1) * $intervalX;
    $y1 = $height - (($lineData[$i - 1] - $minValue) / ($maxValue - $minValue) * $height);
    $x2 = $i * $intervalX;
    $y2 = $height - (($lineData[$i] - $minValue) / ($maxValue - $minValue) * $height);
    imageline($lineChart, $x1, $y1, $x2, $y2, $lineColor);
}

// Crie um gráfico de área
$areaChart = imagecreatetruecolor($width, $height);
$backgroundColor = imagecolorallocate($areaChart, 255, 255, 255);
imagefill($areaChart, 0, 0, $backgroundColor);
$areaColor = imagecolorallocatealpha($areaChart, 0, 0, 255, 63);

imagefilledpolygon($areaChart, [0, $height], 0, 0, 0, $height);
for ($i = 0; $i < $numPoints; $i++) {
    $x = $i * $intervalX;
    $y = $height - (($lineData[$i] - $minValue) / ($maxValue - $minValue) * $height);
    imagefilledrectangle($areaChart, $x, $y, $x + $intervalX, $height, $areaColor);
}

// Exiba os gráficos
header("Content-Type: image/png");
imagepng($pieChart);
imagedestroy($pieChart);

header("Content-Type: image/png");
imagepng($lineChart);
imagedestroy($lineChart);

header("Content-Type: image/png");
imagepng($areaChart);
imagedestroy($areaChart);
?>
