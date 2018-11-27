<?php
session_start();

if(!isset($_POST['username']) or !isset($_POST['password'])) {
    $_SESSION['loginerror'] = "Error: You have to give email and password";
    header('Location: index.php');
    exit();
}

require_once('connect.php');

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);
$conn->set_charset("UTF8");


if($conn->connect_errno == 0) {
    $username = strtolower($_POST['username']);
    $pass = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";

    if($result = $conn->query($query)){
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $userId = $row['user_id'];
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['first_name'];
            header('Location: main.php');

        } else {
            $_SESSION['loginerror'] = "Wrong email or password";
            header('Location: index.php');
        }
    }
} else {
    //echo "$conn->connect_errno";
}
