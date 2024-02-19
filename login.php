<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'tempdb');

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
        }
    }
    header('location:index.php');
}

?>
<section class="my-4">
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
</section>


