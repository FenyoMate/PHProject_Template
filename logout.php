<?php
session_start();
    if(isset($_SESSION['email'])) {
        include_once 'dbcon.php';
        session_destroy();
        debug_to_console("You have been logged out");
    }
    header('location:index.php');

?>
