<?php
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php';
    include __DIR__ . '/includes/redirect_logged_users.php';

    // Redirect logged-in users to their user area
    redirectLoggedInUsers();
    
try {
    $title = 'User Profile: ' . htmlspecialchars($_GET['id']);
    $user = getUserInformation($pdo, $_GET['id']);
    
    // Check if user exists
    if (!$user) {
        header('Location: 404.php');
        exit();
    }
    
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
    include __DIR__ .'/templates/user_page.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'User Profile';
    $output = 'Database error: ' . $e->getMessage();
}

include __DIR__ . '/templates/layout.html.php';
?>