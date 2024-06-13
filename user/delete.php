<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

session_start();
$username = strtolower($_SESSION['username']);
$userInfo = getUserInformation($pdo, $username);

if ($userInfo) {
    $userId = $userInfo['id'];
    deleteUser($pdo, $userId);
    session_destroy();
    header("Location: ../user/profile.php");
    exit;
} else {
    header("Location: ../user/profile.php?error=user_not_found");
    exit;
}
?>
