<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="O Workout Maker dá lhe todos os essencias para criar workouts efetivos!">
    <link rel="stylesheet" href="css/main_styles.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>Workout Maker: Perfil</title>
</head>

<body>

    <nav>
        <a href="index.php?action=home" title="Ir para pagina inicial"><img src="images/logo.png" alt='Workout Maker'><a>
    </nav>

    <main>
        <form action="index.php?action=updateInfo" method="post">
            <label>Descrição do Perfil:</label><br>
            <textarea name="user_description" maxlength="10000"></textarea><br>

            <label>Data de nascimento:</label><br>
            <input type="date" name="birth_date"><br>

            <label>Altura:</label><br>
            <input type="number" name="height_cm"><br>

            <label>Peso:</label><br>
            <input type="number" name="weight_kg"><br><br>

            <button type="submit">Atualizar</button>
        </form>
    </main>

    <footer>
        <p>criado por <a href="https://github.com/MiguelsHere" target="_blank">Miguel Monteiro</a></p>
    </footer>

</body>

</html>