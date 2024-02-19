<?php
include 'scripts.php';
debug_to_console("TESZT");
if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $con = mysqli_connect('localhost', 'root', '', 'tempdb') or die("Connection failed: " . mysqli_connect_error());
        debug_to_console("Sikeresen csatlakozott az adatbázishoz");
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
            $result = mysqli_query($con, $query);
            debug_to_console($email);
            if($result){
                debug_to_console("Sikeresen lefutott a query!");
            };
            if ($result) {
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    debug_to_console("Felhasználó már létezik!");
                    header('location:index.php');
                } else {
                    $_SESSION['email'] = $email;
                    header('location:index.php');
                    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
                    debug_to_console($email);
                    if(mysqli_query($con, $sql)) {
                        debug_to_console("Sikeresen hozzáadva az adatbázishoz!");
                        header('location:index.php');
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        debug_to_console($sql);
                        header('location:index.php');
                    }
                }
            }
        }
        if($con) {
            mysqli_close($con);
        }
    }
debug_to_console($_SERVER);
debug_to_console($_SERVER['REQUEST_METHOD']);
debug_to_console($_POST);

debug_to_console($_POST);

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog space</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<section class="my-4">
    <form action="signup.php" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>

    <a href="index.php">Already have an account? Log in here</a>
</section>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
