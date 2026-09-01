<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <form action="index.php?action=login" method="post">
        <label>Nome de Utilisador:</label><br>
        <input type="text" name="username" minlength="1" maxlength="50" required><br>

        <label>Palavra-Passe:</label><br>
        <input type="password" name="password" minlength="1" maxlength="64" required><br>

        <button type="submit">Entrar</button>
    </form>
</body>

</html>