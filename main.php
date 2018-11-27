<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hmórga</title>
    <meta name="description" content="SocialWebApp"/>
    <meta name="keywords" content="projekt"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<a href="dodajplik.php">Dodaj plik</a><br/>
<a href="dodajdir.php">Dodaj folder</a><br/><br/>

<?php
require_once('connect.php');

$conn = @new mysqli($host, $db_user, $db_pass, $db_name);
$conn->set_charset("UTF8");

if($conn->connect_errno == 0) {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM users_files WHERE user_id = $userId";
    if($result = $conn->query($query)){
        //echo $result->num_rows;
        echo "<table>";
        echo "<tr><th>nazwa</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $fileName = $row['file_name'];
            echo "<tr><th><a href='http://przemekutp.pl/zad7/files/$fileName'>$fileName</a></th></tr>";
        }
    }
} else {
    //echo "$conn->connect_errno";
}

?>

</body>
</html>
