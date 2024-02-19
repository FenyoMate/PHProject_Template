<?php
session_start();
    if(isset($_SESSION['email'])) {
        session_destroy();
        echo  "<h1>You have been logged out</h1>";
    }
    header('location:index.php');

?>
