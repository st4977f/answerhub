<?php
$title = 'About';
include __DIR__ . '/includes/redirect_logged_users.php';

// Redirect logged-in users to their user area (no specific about page in user area, so go to home)
redirectLoggedInUsers('/answerhub/user/user_index');

try {
    ob_start();
    include __DIR__ . '/templates/about.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Error: ' . $e->getMessage();
}
include __DIR__ . '/templates/layout.html.php';
?>