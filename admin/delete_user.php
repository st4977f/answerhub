<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Call deleteUser

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    deleteUser($pdo, $userId);
    header('Location: userlist.php');
    exit;
}

if ($user === false) {
    header("Location: ../404.php");
    exit;
}


header('Location: userlist.php');
exit;
?>
