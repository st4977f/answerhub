<?php
$title = 'Error';

ob_start();

include './templates/incorrect.html.php';
$output = ob_get_clean();

include './templates/layout.html.php';
?>