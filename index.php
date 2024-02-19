
<?php


function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

session_start();

$con = mysqli_connect('localhost', 'root','','tempdb');

if($con){
    debug_to_console( "Connection successful");
}else {
    debug_to_console("No DB connection");
}
if(isset($_SESSION['email'])) {
    debug_to_console($_SESSION['email']);
    include 'navbar.php';
    include 'forum.php';

} else {
    include 'navbar.php';
    include 'login.php';

}

?>




