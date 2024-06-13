<?php
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php'; 
try {
    $title = 'User Profile: ' . htmlspecialchars($_GET['id']);
    $user = getUserInformation($pdo, $_GET['id']);
    $questions = getUserQuestions($pdo, $user['id']);
    $answers = getUserAnswers($pdo, $user['id']);

    $questionsPerPage = 10; // Maximum questions per page

    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $startIndex = ($page - 1) * $questionsPerPage;
    $endIndex = min($startIndex + $questionsPerPage, count($questions));

    $totalPages = ceil(count($questions) / $questionsPerPage);
    $currentPageURL = $_SERVER['PHP_SELF']; // Get the current URL

    ob_start();
    include 'templates/user_page.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'User Profile';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>