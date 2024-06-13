<?php
$title = 'Greenwich AnsweHub - Login';
try {
    ob_start();
    include 'templates/login.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>