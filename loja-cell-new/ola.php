<!DOCTYPE html>
<html>

<head>
    <title>Financeiro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <style>
        body {
            padding: 20px;
        }

        .month-tabs {
            margin-bottom: 20px;
        }

        .month-tabs .nav-link,
        .day-tabs .nav-link {
            cursor: pointer;
        }

        .transactions-content {
            display: none;
        }

        .transactions-content.active {
            display: block;
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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-plus"></i> Adicionar Transação
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-list"></i> Lista de Transações
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-pie"></i> Relatórios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Usuários
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
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar</button>
                </div>
            </form>
        </div>

        <div class="content">
            <h2>Lista de Transações</h2>
            <div class="month-tabs">
                <ul class="nav nav-tabs">
                    <?php foreach ($monthYearTabs as $index => $monthYear) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" data-toggle="tab" href="#<?php echo $monthYear; ?>"><?php echo $monthYear; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php foreach ($transactionsByMonthYear as $monthYear => $transactions) : ?>
                <div id="<?php echo $monthYear; ?>" class="tab-pane fade <?php echo $monthYear === $monthYearTabs[0] ? 'show active' : ''; ?>">
                    <div class="day-tabs">
                        <ul class="nav nav-tabs">
                            <?php for ($day = 1; $day <= 30; $day++) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#<?php echo $monthYear . '-' . $day; ?>"><?php echo $day; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <?php for ($day = 1; $day <= 30; $day++) : ?>
                            <div id="<?php echo $monthYear . '-' . $day; ?>" class="tab-pane fade">
                                <table class="table table-striped">
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
                                        <?php foreach ($transactions as $transaction) : ?>
                                            <?php $transactionDate = date('Y-m-d', strtotime($transaction['date'])); ?>
                                            <?php if ($transactionDate === $monthYear . '-' . str_pad($day, 2, '0', STR_PAD_LEFT)) : ?>
                                                <tr>
                                                    <td><?php echo $transaction['description']; ?></td>
                                                    <td><?php echo $transaction['amount']; ?></td>
                                                    <td><?php echo $transaction['type']; ?></td>
                                                    <td><?php echo $transaction['payer_receiver']; ?></td>
                                                    <td><?php echo $transaction['date']; ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
