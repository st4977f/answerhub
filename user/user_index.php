<?php
$title = 'Greenwich AnswerHub';
include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';
ob_start();

error_reporting(E_ALL);
include __DIR__ . '/user_templates/user_home.html.php';

echo "</br>";
echo "Welcome " . $_SESSION['username'];
echo "</br>";

$output = ob_get_clean();
include __DIR__ . '/user_templates/user_layout.html.php';
?>