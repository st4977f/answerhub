<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Call deleteCategory

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryId'])) {
  $categoryId = $_POST['categoryId'];
  deleteCategory($pdo, $categoryId);
  header('Location: categories.php');
  exit;
}
// Redirect to categories.php if the request is not a valid POST request
header('Location: categories.php');
exit;
?>
