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

    // Verifica se a transação já existe na sessão antes de adicioná-la
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
}

// Agrupa as transações por mês e ano
$transactionsByMonth = [];
foreach ($_SESSION['transactions'] as $transaction) {
    $monthYear = date('F Y', strtotime($transaction['date']));
    if (!isset($transactionsByMonth[$monthYear])) {
        $transactionsByMonth[$monthYear] = [];
    }
    $transactionsByMonth[$monthYear][] = $transaction;
}

// Filtra as transações por data (busca)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_date'])) {
    $searchDate = $_POST['search_date'];
    $filteredTransactions = [];
    foreach ($_SESSION['transactions'] as $transaction) {
        if ($transaction['date'] === $searchDate) {
            $filteredTransactions[] = $transaction;
        }
    }
    $transactionsByMonth = ['Busca' => $filteredTransactions];
}

$total_income = 0;
$total_expense = 0;
$balance = 0;

foreach ($_SESSION['transactions'] as $transaction) {
    if ($transaction['type'] == 'Receita') {
        $total_income += $transaction['amount'];
    } elseif ($transaction['type'] == 'Despesa') {
        $total_expense += $transaction['amount'];
    }
}

$balance = $total_income - $total_expense;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Financeiro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .navbar i {
            color: #fff;
        }

        .navbar-nav {
            margin-top: 50%;

        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            width: 3%;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .navbar .nav-link {
            color: #fff;
            padding: 10px 0;
            width: 100%;
            text-align: center;
        }

        .navbar .nav-link i {
            margin-right: 5px;
        }

        .content {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
        }

        .summary {
            margin-top: 20px;
            padding: 10px;
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .balance-label {
            color: green;
        }

        .negative-balance {
            color: red;
        }

        .reset-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
    </style>
</head>

<body>
    <nav class="navbar d-block">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-plus"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-list"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-pie"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="content">
            <h2>Adicionar Transação</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" name="description" id="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount" class="form-label">Valor:</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="type" class="form-label">Tipo:</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="Receita">Receita</option>
                        <option value="Despesa">Despesa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payer_receiver" class="form-label">Pagador/Recebedor:</label>
                    <input type="text" name="payer_receiver" id="payer_receiver" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date" class="form-label">Data:</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </form>

            <h2>Buscar Transação por Data</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="search_date" class="form-label">Data:</label>
                    <input type="date" name="search_date" id="search_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <h2>Lista de Transações</h2>
            <?php foreach ($transactionsByMonth as $monthYear => $transactions): ?>
                <div class="tabshow">
                    <h3><?php echo $monthYear; ?></h3>
                    <?php foreach ($transactions as $transaction): ?>
                        <div class="transaction">
                            <p>Descrição: <?php echo $transaction['description']; ?></p>
                            <p>Valor: R$ <?php echo number_format($transaction['amount'], 2, ',', '.'); ?></p>
                            <p>Tipo: <?php echo $transaction['type']; ?></p>
                            <p>Pagador/Recebedor: <?php echo $transaction['payer_receiver']; ?></p>
                            <p>Data: <?php echo date('d/m/Y', strtotime($transaction['date'])); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <h2>Resumo Financeiro</h2>
            <div class="summary">
                <p>Total de Receitas: R$ <?php echo number_format($total_income, 2, ',', '.'); ?></p>
                <p>Total de Despesas: R$ <?php echo number_format($total_expense, 2, ',', '.'); ?></p>
                <p class="<?php echo ($balance < 0) ? 'negative-balance' : 'balance-label'; ?>">
                    Saldo: R$ <?php echo number_format($balance, 2, ',', '.'); ?>
                </p>
            </div>

            <form action="" method="post">
                <button type="submit" name="reset" class="btn reset-btn">Resetar Transações</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
