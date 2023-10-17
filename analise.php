<?php


use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\RequestException;

// Crie uma conexão com o banco de dados
$db = new PDO("sqlite:https://joao.tiagofranca.com/portifolioJoao/dadps.db");

// Crie um cliente HTTP
$client = new Client();

// Obtenha os dados do banco de dados
$response = $client->get("http://joao.tiagofranca.com/portifolioJoao/teste.php");

// Converta a resposta JSON em um array
$dados = json_decode($response->getBody(), true);

// Crie um gráfico pizza de satisfação geral
$grafico_pizza_satisfacao_geral = new PieChart($dados["satisfacao_geral"]);
$grafico_pizza_satisfacao_geral->setTitle("Satisfação Geral");

// Crie um gráfico de linha de satisfação com o atendimento
$grafico_linha_satisfacao_atendimento = new LineChart($dados["satisfacao_atendimento"]);
$grafico_linha_satisfacao_atendimento->setTitle("Satisfação com o Atendimento");

// Crie um gráfico de área de satisfação com o atendimento
$grafico_area_satisfacao_atendimento = new AreaChart($dados["satisfacao_atendimento"]);
$grafico_area_satisfacao_atendimento->setTitle("Satisfação com o Atendimento");

// Crie um gráfico pizza de avaliação de assistência técnica
$grafico_pizza_assistencia_tecnica = new PieChart($dados["assistencia_tecnica"]);
$grafico_pizza_assistencia_tecnica->setTitle("Avaliação de Assistência Técnica");

// Crie um gráfico de linha de resolução de problemas
$grafico_linha_resolucao_problemas = new LineChart($dados["resolucao_problemas"]);
$grafico_linha_resolucao_problemas->setTitle("Resolução de Problemas");

// Crie um gráfico de área de resolução de problemas
$grafico_area_resolucao_problemas = new AreaChart($dados["resolucao_problemas"]);
$grafico_area_resolucao_problemas->setTitle("Resolução de Problemas");

// Exiba os gráficos
echo $grafico_pizza_satisfacao_geral->render();
echo $grafico_linha_satisfacao_atendimento->render();
echo $grafico_area_satisfacao_atendimento->render();
echo $grafico_pizza_assistencia_tecnica->render();
echo $grafico_linha_resolucao_problemas->render();
echo $grafico_area_resolucao_problemas->render();

// Feche a conexão com o banco de dados
$db = null;

