<?php
$host = 'localhost';
$db = 'cleaning_service';
$user = 'root'; // update if needed
$pass = ''; // update if needed

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
