<?php
$title = 'About';
try {
    ob_start();
    include 'templates/about.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>