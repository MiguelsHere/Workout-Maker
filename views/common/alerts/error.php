<?php if (!empty($_SESSION['error'])):
    echo
    '<p>' . $_SESSION['error'] . '</p><br>';
    unset($_SESSION['error']);
?>
<?php endif ?>