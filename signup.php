<?php
    $con = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
        $con = mysqli_connect('localhost', 'root', '', 'tempdb') or die("Connection failed: " . mysqli_connect_error());
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
            $result = mysqli_query($con, $query);
            if ($result) {
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    echo "User already exists";
                    header('location:index.php');
                } else {
                    $_SESSION['email'] = $email;
                    header('location:index.php');
                    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
                    if(mysqli_query($con, $sql)) {
                        echo "New record created successfully";
                        header('location:index.php');
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        header('location:index.php');
                    }
                }
            }
        }
    }
    if($con) {
        mysqli_close($con);
    }
?>