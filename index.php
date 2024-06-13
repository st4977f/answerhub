<?php
$title = 'Greenwich AnswerHub';
try {
    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>