<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myshop';

//Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $sql4 = "DELETE FROM clients WHERE id = $id";

    //database connection
    $result4 = mysqli_query($connection, $sql4);
}

header("Location: index.php");
exit;
?>