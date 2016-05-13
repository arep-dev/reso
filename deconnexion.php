<?php
    session_start();

    $_SESSION['log'] = 0;
    $_SESSION['PRO_NUM'] = '';
    session_destroy();
    header('Location: login.php');

?>