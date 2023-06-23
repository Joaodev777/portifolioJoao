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

    $transaction = [
        'description' => $description,
        'amount' => $amount,
        'type' => $type,
        'payer_receiver' => $payer_receiver
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
            margin:0;
            padding:0;
        }
        .navbar i{
            color:#fff;
        }.navbar-nav{
            margin-top:50%;

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
    <nav class="navbar  d-block">
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
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar</button>
                </div>
            </form>
        </div>

        <div class="content">
            <h2>Transações</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Pagador/Recebedor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['transactions'] as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['description']; ?></td>
                        <td><?php echo $transaction['amount']; ?></td>
                        <td><?php echo $transaction['type']; ?></td>
                        <td><?php echo $transaction['payer_receiver']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="content">
            <h2>Resumo Financeiro</h2>
            <div class="summary">
                <p>Total de Receitas: R$ <?php echo $total_income; ?></p>
                <p>Total de Despesas: R$ <?php echo $total_expense; ?></p>
                <p class="balance-label">Saldo: R$ <?php echo $balance; ?></p>
                <?php if ($balance < 0): ?>
                <p class="negative-balance">Atenção: Saldo Negativo!</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="content">
            <form action="" method="post">
                <button type="submit" class="btn reset-btn" name="reset"><i class="fas fa-redo-alt"></i> Resetar</button>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

