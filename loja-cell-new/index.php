<?php
session_start();

if (!isset($_SESSION['transactions'])) {
    $_SESSION['transactions'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $payer_receiver = isset($_POST['payer_receiver']) ? $_POST['payer_receiver'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    $transaction = [
        'description' => $description,
        'amount' => $amount,
        'type' => $type,
        'payer_receiver' => $payer_receiver,
        'date' => $date
    ];

    // Check if the transaction already exists in the session before adding it
    $transactionExists = false;
    foreach ($_SESSION['transactions'] as $existingTransaction) {
        if ($existingTransaction == $transaction) {
            $transactionExists = true;
            break;
        }
    }

    if (!$transactionExists) {
        $_SESSION['transactions'][] = $transaction;
    }
}

if (isset($_POST['reset'])) {
    $_SESSION['transactions'] = [];
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

if (isset($_POST['delete_index'])) {
    $index = $_POST['delete_index'];
    if (isset($_SESSION['transactions'][$index])) {
        unset($_SESSION['transactions'][$index]);
        $_SESSION['transactions'] = array_values($_SESSION['transactions']); // Reindex the array after deletion
    }
}

$selectedMonth = isset($_GET['month']) ? $_GET['month'] : '';
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$selectedDate = isset($_GET['date']) ? $_GET['date'] : '';

$filteredTransactions = $_SESSION['transactions'];

// Filter transactions by the selected month
if ($selectedMonth !== '') {
    $filteredTransactions = array_filter($filteredTransactions, function ($transaction) use ($selectedMonth) {
        return date('m', strtotime($transaction['date'])) === $selectedMonth;
    });
}

// Filter transactions by the search term
if ($searchTerm !== '') {
    $filteredTransactions = array_filter($filteredTransactions, function ($transaction) use ($searchTerm) {
        return stripos($transaction['description'], $searchTerm) !== false;
    });
}

// Filter transactions by the selected date
if ($selectedDate !== '') {
    $filteredTransactions = array_filter($filteredTransactions, function ($transaction) use ($selectedDate) {
        return $transaction['date'] === $selectedDate;
    });
}

$totalIncome = 0;
$totalExpense = 0;

foreach ($filteredTransactions as $transaction) {
    if ($transaction['type'] == 'Receita') {
        $totalIncome += $transaction['amount'];
    } elseif ($transaction['type'] == 'Despesa') {
        $totalExpense += $transaction['amount'];
    }
}

$balance = $totalIncome - $totalExpense;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Financeiro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            transition: 1s;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 10px;
        }

        .a {
            margin-left: 50px;
        }

        .navbar {
            background-image: linear-gradient(to right, rgb(39, 39, 39), rgb(51, 51, 51));
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .print-section,
            .tables,
            .tites,
            .print-section * {
                visibility: visible;
            }

            .tables * {
                display: block;
            }

            .print-section i,
            .actions {
                display: none;
            }

            .titles * {
                display: block;
            }

            .print-section .des {
                width: 350px;
            }

            .print-section td {
                border: 1px solid black;
            }

            .print-section .tables {
                display: block;
            }

            .print-section {
                display: block;
                left: 0;
                top: 0;
                width: 100%;
                font-size: 25px;
                opacity: 1;
                position: fixed;
            }

        }

        .tables {
            display: none;
        }

        .tooltip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip:before {
            content: attr(data-tooltip);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px;
            background-color: #333;
            color: #fff;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .tooltip:hover:before {
            opacity: 1;
        }

        .a:hover .text {
            display: block;
            color: black;
        }

        .text {
            position: absolute;
            bottom: -5px;
            color: black;
            display: none;
            background-color: #89eedd;
            border-radius: 10px;
            color: white;
            transition: 0.5s;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            width: 150px;
            transition: opacity 0.3s ease-in-out;
            font-size: 15px;
        }

        .question h6 {
            color: orange;
        }

        .question {
            height: 100px;
            width: 100%;
            font-size: 15px;
            border-top: 2px solid #cc1d1d;
        }

        .bnt:hover {
            background-image: linear-gradient(to right, rgba(195, 97, 240, 0.526), rgba(103, 255, 227, 0.654));
            scale: 1.1;
        }

        .bnt {
            background-image: linear-gradient(to right, rgba(195, 97, 240, 0.526), rgba(103, 255, 227, 0.654));

            border: purple;
            transition: 0.2s;
        }

        .color {
            color: green;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg position-fixed" id="nav" style="width: 100%;top:0;z-index: 9999;">
        <div class="container-fluid">
            <a class="navbar-brand text-light" style="font-size:30px" href="#">CyberGen</a>

            <div class="navbar-collapse" style="justify-content: center;display: flex;" id="navbarNavAltMarkup">
                <a class="nav-link btn a btn-info " aria-current="page" href="index.php"><i class="fas fa-home home-icon"></i><span class="text ">Voltar</span></a>
                <a class="nav-link btn a btn-success" href="#trans"><i class="fas fa-exchange-alt"></i><span class="text text-dark">Ver Transações</span></a>
                <a class="nav-link btn a btn-danger" href="#res"><i class="fas fa-chart-bar"></i><span class="text text-dark">Ver Resumo</span></a>
                <a class="nav-link btn a btn-warning" data-toggle="modal" data-target="#myModal">
                    <i class="fas fa-question"></i><span class="text text-dark">Tire Suas Duvidas</span>
                </a>

            </div>
        </div>
    </nav><br><br><br>


    <div class="container mt-5 bg-light text-dark">
        <h1 class="mb-4">Sistema Financeiro</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display: block;flex-direction: column;">
            <div class="form-row d-flex">
                <div class="col-md-3 mb-3">
                    <label for="description">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div><br>
                <div class="col-md-2 mb-3">
                    <label for="amount">Valor:</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div><br>
                <div class="col-md-2 mb-3">
                    <label for="type">Tipo:</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="Receita">Receita</option>
                        <option value="Despesa">Despesa</option>
                    </select>
                </div><br>
                <div class="col-md-2 mb-3">
                    <label for="payer_receiver">Pagador/Recebedor:</label>
                    <input type="text" class="form-control" id="payer_receiver" name="payer_receiver" required>
                </div><br>
                <div class="col-md-2 mb-3">
                    <label for="date">Data:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div><br>
            </div>
            <button class="btn btn-primary bnt" type="submit">Adicionar</button>
        </form>

        <div class="mt-4">
            <form class="form-inline">
                <div class="form-group mr-2">
                    <label for="month">Filtrar por mês:</label>
                    <select class="form-control ml-2" id="month" name="month">
                        <option value="">Todos</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="date">Filtrar por data:</label>
                    <input type="date" class="form-control ml-2" id="date" name="date">
                </div>

                <div class="form-group mr-2">
                    <label for="search">Buscar por descrição:</label>
                    <input type="text" class="form-control ml-2" id="search" name="search">
                </div>
                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-warning ml-2" onclick="printTransactions()"><i class="fas fa-print print-icon"></i></button>
            </form>
        </div>

        <div class="mt-4  print-section">
            <h2>Transações -CyberGen</h2>
            <?php if (count($filteredTransactions) > 0) : ?>
                <table class="table" id="trans">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                            <th>Pagador/Recebedor</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filteredTransactions as $index => $transaction) : ?>
                            <tr>
                                <td><?php echo $transaction['description']; ?></td>
                                <td><?php echo number_format($transaction['amount'], 2, ',', '.'); ?></td>
                                <td><?php echo $transaction['type']; ?></td>
                                <td><?php echo $transaction['payer_receiver']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($transaction['date'])); ?></td>
                                <td class="actions">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return confirm('Tem certeza de que deseja excluir esta transação?');">
                                        <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            <?php else : ?>
                <p>Nenhuma transação encontrada.</p>
            <?php endif; ?>
            <div class="mt-4 tables">
                <h2>Resumo Financeiro</h2>
                <p>Total de Receitas: R$ <?php echo number_format($totalIncome, 2, ',', '.'); ?></p>
                <p>Total de Despesas: R$ <?php echo number_format($totalExpense, 2, ',', '.'); ?></p>
                <p class="color">Saldo: R$ <?php echo number_format($balance, 2, ',', '.'); ?></p>

            </div>

        </div>
        <i id="res"></i>
        <div class="mt-4">
            <h2>Resumo Financeiro</h2>
            <p>Total de Receitas: R$ <?php echo number_format($totalIncome, 2, ',', '.'); ?></p>
            <p>Total de Despesas: R$ <?php echo number_format($totalExpense, 2, ',', '.'); ?></p>
            <p class="color">Saldo: R$ <?php echo number_format($balance, 2, ',', '.'); ?></p>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px;style="height:50vh"">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content bg-dark text-light" style="height:70vh">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tirando suas duvidas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height:70vh">
                    <div class="question">
                        <h6>Como imprimir somente um mês ou data específica?</h6>
                        <div class="cont-block">Você irá clicar em filtrar por mês ou por dia e vai selecionar a data de sua escolha, depois você irá clicar na lupa, isso fará o conteúdo do dia ou mês que selecionou aparecer nos botões, depois é só clicar no botão da impressora.</div>
                    </div>

                    <div class="question">
                        <h6>Como posso saber o quanto de gastos ou recebimentos tive no mês de fevereiro?</h6>
                        <div class="cont-block">Você irá selecionar o "Filtro por mês" e vai selecionar o mês de fevereiro, quando tiver selecionado o mês pode clicar no botão vermelho, na parte de cima onde está a logo, isso fará você ir à parte de resumo, lá estará o seu saldo atual, suas receitas e suas despesas.</div>
                    </div>

                    <div class="question">
                        <h6>Quero pesquisar por um pagamento específico, como faço?</h6>
                        <div class="cont-block">Na área acima da tabela há vários tipos de botões, e em um deles está escrito "Buscar por descrição". Você irá digitar o pagamento que você gostaria de localizar e vai clicar na lupa, logo irá aparecer todas as linhas correspondentes. Caso queira por dia específico, você pode selecionar também a data, isso fará buscar por data e pela descrição.</div>
                    </div>

                    <div class="question">
                        <h6>Quero ver quanto me sobrou no ano, quanto gastei e quanto ganhei, como faço isso?</h6>
                        <div class="cont-block">Na área acima da tabela há vários tipos de botões, e em um deles está escrito "Filtrar por mês". Lá você pode colocar em "todos". Assim que você selecionar, clique na lupa. Após fazer isso, pode clicar no botão vermelho na área preta perto da logo. Se passar o mouse em cima, irá dizer "Ver Resumo". Clique em cima e assim você terá o valor que você gastou, o valor que você ganhou e o valor que sobrou.</div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let p = document.querySelector(".color");
            let saldo = parseFloat(p.textContent.replace("R$", "").replace(".", "").replace(",", "."));

            if (saldo < 0) {
                p.style.color = "red";
            } else {
                p.style.color = "green";
            }
        });

        // Obtém os valores dos campos de filtro
        var month = document.getElementById('month').value;
        var date = document.getElementById('date').value;
        var search = document.getElementById('search').value;

        // Aplica a lógica de filtragem
        var filteredTransactions = transactions;

        if (month) {
            filteredTransactions = filteredTransactions.filter(function(transaction) {
                return transaction.month === month;
            });
        }

        if (date) {
            filteredTransactions = filteredTransactions.filter(function(transaction) {
                return transaction.date === date;
            });
        }

        if (search) {
            filteredTransactions = filteredTransactions.filter(function(transaction) {
                return transaction.description.includes(search);
            });
        }

        function printTransactions() {
            // Ocultar todos os elementos, exceto a tabela de transações
            var elementsToHide = document.querySelectorAll('body > *:not(.container):not(script)');
            for (var i = 0; i < elementsToHide.length; i++) {
                elementsToHide[i].style.display = 'none';
            }

            // Imprimir a tabela de transações
            window.print();

            // Restaurar a exibição dos elementos ocultos
            for (var i = 0; i < elementsToHide.length; i++) {
                elementsToHide[i].style.display = '';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
