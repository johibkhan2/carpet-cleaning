<?php session_start(); include 'common/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f2f2f2;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form-wrapper {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #005f73;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
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

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="form-wrapper">
    <h2>Admin Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
      $user = $_POST['username'];
      $pass = $_POST['password'];
      $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($admin = $result->fetch_assoc()) {
        if ($pass === $admin['password']) {
          $_SESSION['admin'] = $admin['username'];
          header("Location: admin/dashboard.php");
          exit();
        }
      }
      echo "<p class='error'>Invalid username or password</p>";
    }
    $logFile = __DIR__ . "/logs/login_debug.log";
file_put_contents($logFile, "Tried login for user: $user\n", FILE_APPEND);
    ?>
  </div>
</body>
</html>
