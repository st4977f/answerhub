<?php
$title = 'My Profile';

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// Get the user ID from the URL parameter and set the title accordingly
$title = 'User Profile: ' . htmlspecialchars($_GET['id']);

// Get the user information, questions, and answers from the database
$user = getUserInformation($pdo, $_GET['id']);
$questions = getUserQuestions($pdo, $user['id']);
$answers = getUserAnswers($pdo, $user['id']);

if ($user === false) {
    header("Location: ../admin/404.php");
    exit;
}

// Pagination logic for the user's questions
$questionsPerPage = 10; // Maximum questions per page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$startIndex = ($page - 1) * $questionsPerPage;
$endIndex = min($startIndex + $questionsPerPage, count($questions));

$totalPages = ceil(count($questions) / $questionsPerPage);

// Get the current page URL
$currentPageURL = $_SERVER['PHP_SELF'];

// Render the user profile page using a template
ob_start();
include __DIR__ .  '/../admin/admin_templates/user_page.html.php';
$output = ob_get_clean();

// Include the layout template for the admin panel
include __DIR__ .  '/../admin/admin_templates/layout.html.php';
?>
