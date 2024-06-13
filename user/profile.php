<?php
$title = 'My Profile';

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

ob_start();

// Get the username in lowercase
$username = strtolower($_SESSION['username']);

// Handle profile image upload if it's a POST request and the profileImage file is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage'])) {
    $image = $_FILES['profileImage'];
    uploadProfileImage($pdo, $username, $image);
}

// Fetch user information based on the username
$user = getUserInformation($pdo, $username);

if ($user === false) {
    header("Location: ../404.php");
    exit;
}

// Fetch user's questions
$questions = getUserQuestions($pdo, $user['id']);

// Fetch user's answers
$answers = getUserAnswers($pdo, $user['id']);

$questionsPerPage = 10; // Maximum questions per page

// Determine the current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$startIndex = ($page - 1) * $questionsPerPage;
$endIndex = min($startIndex + $questionsPerPage, count($questions));

$totalPages = ceil(count($questions) / $questionsPerPage);
$currentPageURL = $_SERVER['PHP_SELF']; // Get the current URL

// Include the profile template
include __DIR__ . '/../user/user_templates/profile.html.php';

// Get the output from the output buffer and clear the buffer
$output = ob_get_clean();

// Include the user layout template
include __DIR__ . '/../user/user_templates/user_layout.html.php';
?>
