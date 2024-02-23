<?php
include 'scripts.php';
function dbConnection()
{
    try {
        $con = mysqli_connect('localhost', 'root', '', 'forumdb');
        if ($con) {
            debug_to_console("Database connection established");
            return $con;
        } else {
            debug_to_console("Undefined issue with the database connection");
            return null;
        }
    } catch (Exception $e) {
        debug_to_console("Exception: " . $e->getMessage());
    }
}

?>