<?php
session_start();
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
    require_once('connect.php');

    addFileToDB($_FILES['plik']['name']);
    echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
    move_uploaded_file($_FILES['plik']['tmp_name'],
        "files/".$_FILES['plik']['name']);

    echo "<a href='main.php'>Powróć do strony głównej<a/>";
}
else {
    header('Location: main.php');
}

function addFileToDB($fileName) {
    require_once('connect.php');

    $conn = @new mysqli("sql.brodeon.nazwa.pl", "brodeon_zad7", "6Cbx2hsb", "brodeon_zad7");
    $conn->set_charset("UTF8");


    if($conn->connect_errno == 0) {
        $userId = $_SESSION['user_id'];
        $query = "INSERT INTO users_files (user_id, directory_id, file_name) VALUES ($userId, 1, '$fileName')";

        if($result = $conn->query($query)){
            echo "dodano do bazy rejestr";
        }
    } else {
        echo "błąd dodania do bazy danych";
    }
}