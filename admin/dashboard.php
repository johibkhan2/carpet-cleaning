<?php include '../common/db.php'; ?>
<?php include '../common/auth.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Orders - Carpet Cleaning</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7f9;
      padding: 40px;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .top-bar a {
      color: #0077b6;
      text-decoration: none;
    }

    .filter-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .filter-form label {
      font-weight: bold;
      margin-right: 5px;
    }

    .filter-form input, .filter-form select, .filter-form button, .filter-form a {
      padding: 8px 12px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .filter-form button {
      background: #0077b6;
      color: white;
      border: none;
      cursor: pointer;
    }

    .filter-form button:hover {
      background: #023e8a;
    }

    .filter-form a {
      background: #ccc;
      text-decoration: none;
    }

    .add-btn {
      display: inline-block;
      margin: 20px 0;
      padding: 10px 16px;
      background: #2a9d8f;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s;
    }

    .add-btn:hover {
      background: #21867a;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
      text-align: left;
      font-size: 14px;
    }

    th {
      background: #0077b6;
      color: white;
    }

    tr:hover {
      background: #f1f9ff;
    }

    .actions a {
      margin-right: 8px;
      color: #0077b6;
      font-weight: bold;
    }

    .actions a:hover {
      text-decoration: underline;
    }

    .pagination {
      margin-top: 20px;
      text-align: center;
    }

    .pagination a, .pagination span {
      padding: 8px 12px;
      margin: 0 4px;
      border-radius: 5px;
      text-decoration: none;
      border: 1px solid #aaa;
      color: #333;
    }

    .pagination a:hover {
      background: #0077b6;
      color: white;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <h2>Cleaning Orders</h2>
    <p>Welcome, <?= $_SESSION['admin'] ?> | <a href="logout.php">Logout</a></p>
  </div>

  <form method="GET" class="filter-form">
    <label>Status:</label>
    <select name="status">
      <option value="">-- All --</option>
      <option <?= @$_GET['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
      <option <?= @$_GET['status'] == 'In-Progress' ? 'selected' : '' ?>>In-Progress</option>
      <option <?= @$_GET['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <label>From:</label>
    <input type="date" name="from" value="<?= @$_GET['from'] ?>">

    <label>To:</label>
    <input type="date" name="to" value="<?= @$_GET['to'] ?>">

    <button type="submit">Filter</button>
    <a href="index.php">Reset</a>
  </form>

  <!-- <a href="create.php" class="add-btn">+ Add New Order</a> -->

  <table>
    <tr>
      <th>ID</th><th>Type</th><th>Size</th><th>Carpet Type</th>
      <th>Name</th><th>Email</th><th>Phone</th><th>Status</th><th>Actions</th>
    </tr>

    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $where = [];

    if (!empty($_GET['status'])) {
      $status = $conn->real_escape_string($_GET['status']);
      $where[] = "status = '$status'";
    }

    if (!empty($_GET['from']) && !empty($_GET['to'])) {
      $from = $conn->real_escape_string($_GET['from']);
      $to = $conn->real_escape_string($_GET['to']);
      $where[] = "DATE(created_at) BETWEEN '$from' AND '$to'";
    }

    $where_sql = count($where) ? "WHERE " . implode(" AND ", $where) : "";

    $total_query = "SELECT COUNT(*) as total FROM orders $where_sql";
    $total_result = $conn->query($total_query);
    $total_rows = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $limit);

    $query = "SELECT * FROM orders $where_sql ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['carpet_or_duvet']}</td>
        <td>{$row['size']}</td>
        <td>{$row['type_of_carpet']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone1']}</td>
        <td>{$row['status']}</td>
        <td class='actions'>
          <a href='edit.php?id={$row['id']}'>Edit</a>
          <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
        </td>
      </tr>";
    }
    ?>
  </table>

  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">« Prev</a>
    <?php endif; ?>

    <span>Page <?= $page ?> of <?= $total_pages ?></span>

    <?php if ($page < $total_pages): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next »</a>
    <?php endif; ?>
  </div>
</body>
</html>
