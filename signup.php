<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
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

?>