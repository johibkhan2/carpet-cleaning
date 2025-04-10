<?php include 'db.php';
include 'auth.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM orders WHERE id = $id");
$order = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $conn->prepare("UPDATE orders SET 
    carpet_or_duvet=?, size=?, type_of_carpet=?, name=?, email=?, phone1=?, phone2=?, size_number=?, status=?
    WHERE id=?");

  $stmt->bind_param("sssssssis", 
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
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Order</title></head>
<body>
  <h2>Edit Cleaning Order</h2>
  <form method="POST">
    <label>Carpet or Duvet:</label>
    <select name="carpet_or_duvet">
      <option <?= $order['carpet_or_duvet'] == 'Carpet' ? 'selected' : '' ?>>Carpet</option>
      <option <?= $order['carpet_or_duvet'] == 'Duvet' ? 'selected' : '' ?>>Duvet</option>
    </select><br><br>

    <label>Size:</label><input name="size" value="<?= $order['size'] ?>"><br><br>
    <label>Type of Carpet:</label><input name="type_of_carpet" value="<?= $order['type_of_carpet'] ?>"><br><br>
    <label>Name:</label><input name="name" value="<?= $order['name'] ?>"><br><br>
    <label>Email:</label><input name="email" value="<?= $order['email'] ?>"><br><br>
    <label>Phone 1:</label><input name="phone1" value="<?= $order['phone1'] ?>"><br><br>
    <label>Phone 2:</label><input name="phone2" value="<?= $order['phone2'] ?>"><br><br>
    <label>Size (number):</label><input name="size_number" type="number" step="0.1" value="<?= $order['size_number'] ?>"><br><br>
    <label>Status:</label>
    <select name="status">
      <option <?= $order['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
      <option <?= $order['status'] == 'In-Progress' ? 'selected' : '' ?>>In-Progress</option>
      <option <?= $order['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select><br><br>

    <button type="submit">Update</button>
  </form>
</body>
</html>
