<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O Workout Maker dá lhe todos os essencias para criar workouts efetivos!">
    <link rel="stylesheet" href="css/main_styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Workout Maker: Inicio</title>
</head>

<body>

    <nav>
        <a href="index.php?action=home" title="Ir para pagina inicial"><img src="images/logo.svg" alt='Workout Maker' width="220" height="60"></a>
        <?php if (empty($_SESSION['user_id'])): ?>
            <a href="index.php?action=login" title="Ir para pagina de login">Entrar</a>
            <span>/</span>
            <a href="index.php?action=register" title="Ir para pagina de registo">Registar</a>
        <?php else: ?>
            <a href="index.php?action=sign-out">Sair</a>
        <?php endif ?>
    </nav>

    <main>

    </main>

    <footer>
        <p>criado por <a href="https://github.com/MiguelsHere" target="_blank">Miguel Monteiro</a></p>
    </footer>

</body>

</html>