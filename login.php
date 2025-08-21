<?php
$title = 'Greenwich AnsweHub - Login';
include __DIR__ . '/includes/redirect_logged_users.php';

// Redirect logged-in users to their user area
redirectLoggedInUsers('/answerhub/user/user_index');

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