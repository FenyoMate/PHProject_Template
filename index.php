<?php
include 'dbcon.php';

session_start();

$con = dbConnection();

if(isset($_SESSION['email'])) {
    debug_to_console($_SESSION['email']);
    include 'navbar.php';
    include 'forum.php';

} else {
    include 'navbar.php';
    include 'login.php';

}

?>




