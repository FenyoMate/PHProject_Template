<?php
//This function is for debugging purposes
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
//TODO Gather up the most used functions and put them here for cleaner code



?>

