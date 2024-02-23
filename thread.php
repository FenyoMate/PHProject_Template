<?php
session_start();
include_once 'navbar.php';
include_once 'dbcon.php';
$con = dbConnection();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
// Get the comments
if (isset($_GET['thread_id'])) {
    $threadid = $_GET['thread_id'];

    $sql = "SELECT * FROM `threads` WHERE id=$threadid";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $desc = $row['content'];
    }
}

// Post a comment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    //Fetching needed data
    //Thread id
    $threadid = $_POST['thread_id'];
    //Comment by
    $sql = "SELECT id FROM `users` WHERE email='" . $_SESSION['email'] . "'";
    $result = mysqli_query($con, $sql);
    $comment_by = mysqli_fetch_assoc($result)['id'];

    //Comment itself
    $comment = $_POST['comment'];

    //Inserting the comment
    $sql = "INSERT INTO comments (comment, comment_by, thread_id) VALUES ('$comment', '$comment_by', '$threadid')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location:thread.php?thread_id=' . $threadid);
    }
}


?>

<div class="container">
    <div class="row">
        <h1 class="display-4"><?php echo $title; ?></h1>
    </div>
    <div class="row">
        <p class="lead"><?php echo $desc; ?></p>
    </div>
    <hr class="my-4">
</div>
<div class="container">
    <!-- comments -->
    <?php
    if (isset($_GET['thread_id'])) {
        $threadid = $_GET['thread_id'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$threadid";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "SELECT email FROM `users` WHERE id=" . $row['comment_by'];
            $user = mysqli_query($con, $sql);
            $user = mysqli_fetch_assoc($user)['email'];
            $comment = $row['comment'];
            echo '<div class="row">';
            echo '<div class="col-2">';
            echo '<p>' . $user . '</p>';
            echo '</div>';
            echo '<div class="col-10">';
            echo '<p>' . $comment . '</p>';
            echo '</div>';
            echo '</div>';

        }
        if (!mysqli_num_rows($result)) {
            echo "<p>No comments found! Be the first who comments!</p>";
        }
    }
    ?>

</div>
<div class="container">
    <!-- comment form -->
    <div class="row">
        <div class="col-12">
            <form action="thread.php" method="post">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <input type="hidden" name="thread_id" value="<?php echo $_GET['thread_id']; ?>">
                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div>
    </div>
</div>
