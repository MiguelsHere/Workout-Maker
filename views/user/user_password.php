<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O Workout Maker dá lhe todos os essencias para criar workouts efetivos!">
    <link rel="stylesheet" href="css/main_styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Workout Maker: Nova Palavra-passe</title>
</head>

<body>

    <nav>
        <a href="index.php?action=home" title="Ir para pagina inicial"><img src="images/logo.svg" alt='Workout Maker' width="220" height="60"></a>
        <a href="index.php?action=sign-out">Sair</a>
    </nav>

    <?php if (empty($_SESSION['success'])): ?>
        <main>
            <form action="index.php?action=new-password" method="post">

                <label>Palavra-passe:</label><br>
                <input type="password" name="password" minlength="15" maxlength="64" autocomplete="current-password" required><br><br>

                <label>Nova Palavra-passe:</label><br>
                <input type="password" name="new_password" minlength="15" maxlength="64" autocomplete="new-password" required>

                <button type="submit">Substituir Palavra-passe</button>
            </form>
        </main>
    <?php else:
        echo
        '<main>
        <p>' . htmlspecialchars($_SESSION['success']) . '</p>
        </main>';
        unset($_SESSION['success']);
    ?>
    <?php endif ?>

    <footer>
        <p>criado por <a href="https://github.com/MiguelsHere" target="_blank">Miguel Monteiro</a></p>
    </footer>

</body>

</html>