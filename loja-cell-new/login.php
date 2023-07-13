<?php
session_start();

if (empty($_POST) || empty($_POST["usuario"]) || empty($_POST["senha"])) {
    // Redirecionar de volta para o formulário de login se não houver dados fornecidos
    header("Location: index.php");
    exit;
}

include('config.php');

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios
        WHERE usuario = '{$usuario}'
        AND senha = '{$senha}'";

$res = $conn->query($sql) or die($conn->error);

$qtd = $res->num_rows;

if ($qtd > 0) {
    $row = $res->fetch_object();
    // Autenticação bem-sucedida, definir as variáveis de sessão
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nome'] = $row->$nome;
    $_SESSION["tipo"] = $row->$tipo;
    header("Location: dashboard.php");
    exit;
} else {
    print  "<script>alert('Usuário e/ou senha incorreto(s)')</script>";
    print  "<script>location.href='index.php'</script>";
}
?>
