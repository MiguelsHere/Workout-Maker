<?php if (!empty($_SESSION['alert'])):
    echo
    '<p>' . $_SESSION['alert'] . '</p><br>';
    unset($_SESSION['alert']);
?>
<?php endif ?>