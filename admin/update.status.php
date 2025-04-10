<?php
include '../common/db.php';
include '../common/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)$_POST['id'];
  $status = $conn->real_escape_string($_POST['status']);

  $valid_statuses = ['Open', 'In-Progress', 'Completed'];
  if (!in_array($status, $valid_statuses)) {
    echo 'invalid';
    exit;
  }

  $query = "UPDATE orders SET status = '$status' WHERE id = $id";
  if ($conn->query($query)) {
    echo 'success';
  } else {
    echo 'error';
  }
}
?>
