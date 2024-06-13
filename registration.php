<?php
$title = 'Greenwich AnsweHub - Registration';
try {
    ob_start();
    include 'templates/registration.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>