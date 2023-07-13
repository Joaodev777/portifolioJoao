
<!DOCTYPE html>
<html>
<head>
    <title>Enviar Lembrete</title>
</head>
<body>
    <h2>Enviar Lembrete</h2>
    <form method="POST" action="enviar_email.php">
        <label>Data:</label>
        <input type="date" name="data" required><br><br>

        <label>Empresa:</label>
        <input type="text" name="empresa" required><br><br>

        <label>Motivo:</label>
        <input type="text" name="motivo" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <input type="submit" name="submit" value="Enviar">
    </form>
</body>
</html>
