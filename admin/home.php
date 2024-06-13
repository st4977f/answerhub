<?php
$title = 'Admin Panel';
try {
    ob_start();

    include __DIR__ . '/admin_templates/index.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Error: ' . $e->getMessage();
}
include __DIR__ . '/admin_templates/layout.html.php';
