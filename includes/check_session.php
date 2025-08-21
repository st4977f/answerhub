<?php
// Check if the user is logged in
function checkLoggedIn() {
    // Check if the 'username' session variable is not set
    if (!isset($_SESSION['username'])) {
        header('Location: /answerhub/login');
        exit();
    }
}
checkLoggedIn();
?>
