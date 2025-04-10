<?php include '../common/db.php'; ?>
<?php include '../common/auth.php'; ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

if (isset($_COOKIE['editOrderId'])) {
  $id = $_COOKIE['editOrderId'];
  echo "Order ID from cookie: " . $id;
} else {
  http_response_code(400);
}

// if () {
//   http_response_code(400);
//   echo "Invalid request: ID is missing or invalid.";
//   exit;
// }

// $id = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM orders WHERE id = $id");
$order = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $result = $conn->query("SELECT * FROM orders WHERE id = $id");
  $order = $result->fetch_assoc();
  $stmt = $conn->prepare("UPDATE orders SET 
    carpet_or_duvet=?, size=?, type_of_carpet=?, name=?, email=?, phone1=?, phone2=?, size_number=?, status=?
    WHERE id=?");

  $stmt->bind_param("sssssssssi", 
    $_POST['carpet_or_duvet'],
    $_POST['size'],
    $_POST['type_of_carpet'],
    $_POST['name'],
    $_POST['email'],
    $_POST['phone1'],
    $_POST['phone2'],
    $_POST['size_number'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
  echo "<script>window.parent.postMessage('closeBookingModal', '*');</script>";
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Order</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f4;
    }

    .form-wrapper {
      position: relative;
      overflow-y: auto;
      max-width: 80%;
      max-height: 90vh;

      position: relative;
      background: white;
      margin: 20px auto;
      padding: 15px;
      border-radius: 5px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      max-width: 600px;
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin: 15px 0 5px;
    }

    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 4px;
      border: 1px solid #ccc;
      border-radius: 2px;
    }

    button {
      margin-top: 20px;
      padding: 5px 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .close-btn {
      background-color: #6c757d;
      margin-left: 10px;
    }

    .button-group {
      display: flex;
      justify-content: center;
      /* gap: 10px; */
    }
  
    .close-icon {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      cursor: pointer;
      color: #888;
    }

    .close-icon:hover {
      color: #000;
    }
    </style>
</head>


<div class="form-wrapper">
  <span class="close-icon" onclick="closeModal()">&times;</span>
  <h2>Edit Cleaning Order</h2>
  <form id="editForm" method="POST">
    <label>Carpet or Duvet:</label>
    <select name="carpet_or_duvet">
      <option <?= $order['carpet_or_duvet'] == 'Carpet' ? 'selected' : '' ?>>Carpet</option>
      <option <?= $order['carpet_or_duvet'] == 'Duvet' ? 'selected' : '' ?>>Duvet</option>
    </select>

    <label>Size:</label>
    <input type="text" name="size" value="<?= $order['size'] ?>">

    <label>Type of Carpet:</label>
    <input type="text" name="type_of_carpet" value="<?= $order['type_of_carpet'] ?>">

    <label>Name:</label>
    <input type="text" name="name" value="<?= $order['name'] ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= $order['email'] ?>">

    <label>Phone 1:</label>
    <input type="text" name="phone1" value="<?= $order['phone1'] ?>">

    <label>Phone 2:</label>
    <input type="text" name="phone2" value="<?= $order['phone2'] ?>">

    <label>Size Number:</label>
    <input type="text" name="size_number" value="<?= $order['size_number'] ?>">

    <label>Status:</label>
    <select name="status">
      <option value="Open" <?= $order['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
      <option value="In-Progress" <?= $order['status'] == 'In-Progress' ? 'selected' : '' ?>>In Progress</option>
      <option value="Completed" <?= $order['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <input type="hidden" name="id" value="<?= $order['id'] ?>">

    <div class="button-group">
      <button type="submit">Save</button>
      <button type="button" class="close-btn" onclick="closeModal()">Close</button>
    </div>
  </form>
</div>
<script>
  function closeModal() {
    window.parent.postMessage('closeBookingModal', '*');
  }
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const editForm = document.getElementById('editForm');

  if (editForm) {
    // Create a hidden input to hold the ID from localStorage
    // let hiddenId = document.createElement('input');
    // hiddenId.type = 'hidden';
    // hiddenId.name = 'id';
    // hiddenId.value = localStorage.getItem('editOrderId');
    // editForm.appendChild(hiddenId);
    document.querySelector('input[name="id"]').value = localStorage.getItem('editOrderId');
    console.log('ID from localStorage:', localStorage.getItem('editOrderId'));
  }
});
</script>

