<?php
try{
    @session_start();
} catch (Exception $e){
    echo "Session start failed";
}
include_once('dbcon.php');

$con = dbConnection();
//Loopback to index if not logged in
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Forum</h1>
            <ul class="list-group">
                <?php
                //Get the threads
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['email']) {
                    $query = "SELECT * FROM threads ORDER BY id DESC;";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        //List the threads
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sql = "SELECT COUNT(*) AS answers FROM comments WHERE thread_id = " . $row['id'];
                            $result2 = mysqli_query($con, $sql);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo '
                            <a href="thread.php?thread_id=' . $row['id'] . '">
                                <li class="list-group-item d-flex justify-content-between align-items-center">' . $row['title'] . '
                                    <span class="badge badge-primary badge-pill">'.$row2['answers'].'</span> 
                                </li>
                            </a>
                            ';
                        };
                    } else {
                        echo "No threads found!";
                    }

                }
                ?>
            </ul>
        </div>
    </div>
</div>
