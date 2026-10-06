<?php if (empty($_SESSION['success'])):
    '<p>' . $_SESSION['success'] . '</p><br>';
    unset($_SESSION['success']);
?>
<?php endif ?>