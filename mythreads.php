<?php
session_start();

function get_user_id($email)
{
    $con = mysqli_connect('localhost', 'root', '', 'tempdb');
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return -1;
    }
};



include 'navbar.php';
include 'scripts.php';

$con = mysqli_connect('localhost', 'root', '', 'tempdb');

if ($con) {
    debug_to_console("Connection successful");
} else {
    debug_to_console("No DB connection");
}

if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem']))
{
    $id = $_POST['deleteItem'];
    $query = "DELETE FROM threads WHERE id = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        debug_to_console("Sikeresen lefutott a query!");
        header('location:mythreads.php');
    } else {
        debug_to_console("Sikertelen a query lefutása!");
    };
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['title']) && ($_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_by = get_user_id($_SESSION['email']);
    $query = "INSERT INTO threads (title, content, created_by) VALUES ('$title', '$content',$created_by)";
    $result = mysqli_query($con, $query);
    if ($result) {
        debug_to_console("Sikeresen lefutott a query!");
        header('location:mythreads.php');
    } else {
        debug_to_console("Sikertelen a query lefutása!");
    };

}


?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>My Threads</h1>
            <ul class="list-group">
                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['email']) {
                    $query = "SELECT * FROM threads";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        echo '';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <form action="mythreads.php" method="post">
                            <li class="list-group-item d-flex justify-content-between align-items-center">' . $row['title'] . '
                                <button type="submit" class="badge badge-secondary badge-danger" name="deleteItem" value="'.$row['id'].'" />Delete</button>
                                <span class="badge badge-primary badge-pill">14</span> 
                            </li>
                            </form>
                            ';
                        };//TODO answer tábla+counter erre a részre
                    } else {
                        echo "No threads found!";
                    }

                }

                ?>
            </ul>
        </div>
        <div class="col-6">
            <h1>New thread</h1>
            <form action="mythreads.php" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea type="textarea" class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
