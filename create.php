<?php include 'common/db.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $conn->prepare("INSERT INTO orders 
  (carpet_or_duvet, size, type_of_carpet, name, email, phone1, phone2, size_number)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  $stmt->bind_param("ssssssis",
    $_POST['carpet_or_duvet'],
    $_POST['size'],
    $_POST['type_of_carpet'],
    $_POST['name'],
    $_POST['email'],
    $_POST['phone1'],
    $_POST['phone2'],
    $_POST['size_number']
  );

  $stmt->execute();
  echo "<script>window.parent.postMessage('closeBookingModal', '*');</script>";
  // closeModal();
  exit();
}
?>

<!DOCTYPE html>
<head>
  <title>Create Order</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>

    .form-wrapper {
      position: relative;
      background: white;
      /* max-width: 600px; */
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    } 

    .close-icon {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      color: #888;
      cursor: pointer;
    }

    .close-icon:hover {
      color: #000;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #005f73;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      margin-top: 15px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      margin-top: 25px;
      width: 100%;
      background: #0a9396;
      color: white;
      border: none;
      padding: 15px;
      font-size: 1.1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #00757d;
    }
  </style>
</head>
<!-- <body> -->

  <div class="form-wrapper">
    <span class="close-icon" onclick="closeModal()">&times;</span>
    <h2>Create New Cleaning Order</h2>
    <form method="POST">
      <label>Carpet or Duvet:</label>
      <select name="carpet_or_duvet" required>
        <option value="">-- Select --</option>
        <option>Carpet</option>
        <option>Duvet</option>
      </select>

      <label>Size:</label>
      <input name="size" required>

      <label>Type of Carpet:</label>
      <input name="type_of_carpet" required>

      <label>Name:</label>
      <input name="name" required>

      <label>Email:</label>
      <input name="email" type="email">

      <label>Phone 1:</label>
      <input name="phone1">

      <label>Phone 2:</label>
      <input name="phone2">

      <label>Size (number):</label>
      <input name="size_number" type="number" step="0.1">
<!-- 
      <label>Status:</label>
      <select name="status" required>
        <option value="">-- Select Status --</option>
        <option>Open</option>
        <option>In-Progress</option>
        <option>Completed</option>
      </select> -->

      <button type="submit">Create Order</button>
    </form>
  </div>

  <script>
    function closeModal() {
      window.parent.postMessage('closeBookingModal', '*');
    }
  </script>

<!-- </body>
</html> -->
