<?php
session_start();

// Função para verificar se o usuário está logado
function isLoggedIn()
{
    return isset($_SESSION['username']);
}

// Função para criar um novo usuário
function createUser($username, $password)
{
    // Armazene o novo usuário em um banco de dados seguro
    // Neste exemplo, vamos armazenar em um arquivo de texto
    $userData = $username . ':' . password_hash($password, PASSWORD_DEFAULT) . PHP_EOL;
    file_put_contents('users.txt', $userData, FILE_APPEND);
}

// Função para autenticar o usuário
function authenticate($username, $password)
{
    // Recupere os usuários do banco de dados ou do arquivo
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($storedUsername, $hashedPassword) = explode(':', $user);
        if ($username === $storedUsername && password_verify($password, $hashedPassword)) {
            return true;
        }
    }

    return false;
}

// Lidar com o envio do formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (authenticate($username, $password)) {
        // Autenticação bem-sucedida, definir a sessão do usuário
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        // Autenticação falhou, exibir uma mensagem de erro
        $errorMessage = 'Nome de usuário ou senha inválidos.';
    }
}

// Lidar com o envio do formulário de criação de usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Criar um novo usuário
    createUser($username, $password);

    // Definir a sessão do usuário recém-criado
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit;
}

// Redirecionar para a página protegida se o usuário estiver logado
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Login</h2>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <h2 class="text-center mt-4">Criar novo usuário</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="new-username">Novo usuário:</label>
                <input type="text" class="form-control" name="username" id="new-username" required>
            </div>
            <div class="form-group">
                <label for="new-password">Nova senha:</label>
                <input type="password" class="form-control" name="password" id="new-password" required>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="create">Criar usuário</button>
        </form>
    </div>
</body>
</html>
