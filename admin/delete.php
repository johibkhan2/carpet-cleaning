<?php
include 'db.php';
include 'auth.php';
$id = $_GET['id'];
$conn->query("DELETE FROM orders WHERE id = $id");
header("Location: index.php");
exit();
