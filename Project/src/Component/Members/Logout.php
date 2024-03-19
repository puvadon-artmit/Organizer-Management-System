<?php
   
    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    unset($_SESSION['organizer_login']);
    header('location: ../../View/Login.php');

?>