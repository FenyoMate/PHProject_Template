<?php
    session_start();
    
    $con = mysqli_connect('localhost', 'root');

    if($con){
        echo "Connection successful";
    }else{
        echo "No DB connection";

    }

    mysqli_select_db($con, 'tempdb');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' && password = '$password'";

    $result = mysqli_query($con, $query);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            $_SESSION['email'] = $email;
            header('location:index.php');
        } else {
            header('location:signup.php');
        }
    }

    ?>



