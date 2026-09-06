<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O Workout Maker dá lhe todos os essencias para criar workouts efetivos!">
    <link rel="stylesheet" href="css/main_styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Workout Maker: Criar Workout</title>
</head>

<body>

    <nav>
        <a href="index.php?action=home" title="Ir para pagina inicial"><img src="images/logo.svg" alt='Workout Maker' width="220" height="60"></a>
        <a href="index.php?action=sign-out">Sair</a>
    </nav>

    <main>
        <form action="index.php?action=create" method="post">
            <label>Nome do Workout:</label><br>
            <input type="text" name="workout_name" maxlength="50" required><br><br>

            <label>Descrição do workout:</label><br>
            <textarea name="workout_description"></textarea><br><br>

            <label>Tempo necessario em média:</label><br>
            <input type="number" name="time_min">

            <label>Publico:</label>
            <input type="checkbox" name="is_public"><br><br>

            <button type="submit">Criar Workout</button>
        </form>
    </main>

    <footer>
        <p>criado por <a href="https://github.com/MiguelsHere" target="_blank">Miguel Monteiro</a></p>
    </footer>

</body>

</html>