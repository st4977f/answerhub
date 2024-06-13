<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['email'])) {
    $username = $_SESSION['username'];

    // Get the user's information from the database
    $user = getUserInformation($pdo, $username);
    $userId = $user['id'];
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];

    // Check if the user is editing their own details
    if ($user['id'] != $userId) {
        echo 'You are not authorized to edit this user.';
        exit;
    }
    if ($user === false) {
        header("Location: ../404.php");
        exit;
    }

    // Update the user's details in the database
    updateUser($pdo, $userId, $newUsername, $newEmail);

    // Update the user's details in the session
    $_SESSION['username'] = $newUsername;

    // Redirect to a success page or another appropriate location
    header('Location: profile.php');
    exit;
}
// Redirect to an appropriate location if the request is not a valid POST request
header('Location: profile.php');
exit;
?>
