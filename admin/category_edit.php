<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Call editCategory
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryId'], $_POST['categoryName'])) {
  $categoryId = $_POST['categoryId'];
  $categoryName = $_POST['categoryName'];
  updateCategory($pdo, $categoryId, $categoryName);
  header('Location: categories.php');
  exit;
}

if ($question === false) {
  header("Location: ../admin/404.php");
  exit;
}


// Redirect to categories.php if the request is not a valid POST request
header('Location: categories.php');
exit;
?>
