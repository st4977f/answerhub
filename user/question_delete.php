<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $questionId = $_GET['id'];
    deleteQuestion($pdo, $questionId);
    header('Location: ../user/questions.php');
    exit;
}
header("Location: ../user/questions.php");
?>