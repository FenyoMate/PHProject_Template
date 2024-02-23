<?php
include_once 'navbar.php';
//Login handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'dbcon.php';
    session_start();
    $con = dbConnection();

    mysqli_select_db($con, 'forumdb');
    $email = $_POST['email'];
    $password = $_POST['password'];
    //TODO: hash password and email


    $query = "SELECT * FROM users WHERE email = '$email' && password = '$password'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1){
            $_SESSION['email'] = $email;
            header('location:index.php');
    }else{
        $_SESSION['login_error'] = "Invalid email or password!";
    }
}

?>
<div class="container">
    <div class="row">
        <h1 class="display-5">Log in</h1>
    </div>
    <div class="row">
        <div class="col-4">
            <section class="my-3">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                               placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
                <br>
                <?php
                if (isset($_SESSION['login_error'])){
                    debug_to_console($_SESSION['login_error']);
                    echo '<div class="alert alert-danger" role="alert">'.$_SESSION['login_error'].'</div>';
                    unset($_SESSION['login_error']);
                }
                ?>
            </section>
        </div>
</div>



