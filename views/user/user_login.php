<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O Workout Maker dá lhe todos os essencias para criar workouts efetivos!">
    <link rel="stylesheet" href="css/main_styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Workout Maker: Entrar</title>
</head>

<body>

    <nav>
        <a href="index.php?action=home" title="Ir para pagina inicial"><img src="images/logo.svg" alt="Workout Maker" width="220" height="60"></a>
        <a href="index.php?action=login" title="Ir para pagina de login">Entrar</a>
        <span>/</span>
        <a href="index.php?action=register" title="Ir para pagina de registo">Registar</a>
    </nav>

    <?php if (empty($_SESSION['error'])): ?>
        <main>
            <form action="index.php?action=login" method="post">
                <label>Nome de Utilisador:</label><br>
                <input type="text" name="user_name" maxlength="50" autocomplete="username" required><br><br>

                <label>Palavra-Passe:</label><br>
                <input type="password" name="password" minlength="15" maxlength="64" autocomplete="current-password" required><br><br>

                <button type="submit">Entrar</button>
            </form>
        </main>
    <?php else:
        echo
        '<main>
        <p>' . htmlspecialchars($_SESSION['error']) . '</p>
        </main>';
        unset($_SESSION['error']);
    ?>
    <?php endif ?>

    <footer>
        <p>criado por <a href="https://github.com/MiguelsHere" target="_blank">Miguel Monteiro</a></p>
    </footer>

</body>

</html>