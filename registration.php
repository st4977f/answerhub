<?php
$title = 'Greenwich AnsweHub - Registration';
include __DIR__ . '/includes/redirect_logged_users.php';

// Redirect logged-in users to their user area
redirectLoggedInUsers('/answerhub/user/user_index');

try {
    ob_start();
    include __DIR__ . '/templates/registration.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include __DIR__ .'/templates/layout.html.php';
?>