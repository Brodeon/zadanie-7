<?php
require_once('connect.php');

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);
$conn->set_charset("UTF8");


if($conn->connect_errno == 0) {
    $username = strtolower($_POST['username']);
    $pass = $_POST['password'];
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$pass')";

    if($result = $conn->query($query)){
        if($result->num_rows == 1) {

            header('Location: index.php');

        } else {
            header('Location: index.php');
        }
    }
} else {
    //echo "$conn->connect_errno";
}
