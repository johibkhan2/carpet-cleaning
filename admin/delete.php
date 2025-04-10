<?php
include '../common/db.php';
include '../common/auth.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Delete the order from the database
    $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Optional: close the statement
    $stmt->close();
}

// Redirect back to dashboard (preserving filters like ?status=Open)
$redirect = $_SERVER['HTTP_REFERER'] ?? 'dashboard.php';
header("Location: $redirect");
exit;
?>
