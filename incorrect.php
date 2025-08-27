<?php
$title = 'Error';

ob_start();

include __DIR__ . '/templates/incorrect.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/layout.html.php';
?>