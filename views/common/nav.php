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