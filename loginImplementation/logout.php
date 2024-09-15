<?php
    require 'interfaceController.php';
    $_SESSION = [];
    session_destroy();
    session_unset();
    header("location:loggedinterface.php");

?>