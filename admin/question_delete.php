<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Call deleteQuestion

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $questionId = $_GET['id'];
    deleteQuestion($pdo, $questionId);
    header('Location: questions.php');
    exit;
}
header('Location: questions.php');
exit;
