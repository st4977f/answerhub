<?php
$title = 'Admin - List of Questions';

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
    // Get the list of questions from the database
    $questions = getQuestions($pdo);

    // Calculate the total number of questions and answers
    $totalQuestions = totalQuestions($pdo);
    $totalAnswers = totalAnswers($pdo, 'id');

    // Pagination logic
    $questionsPerPage = 15;
    $totalPages = ceil($totalQuestions / $questionsPerPage);

    // Determine the current page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }

    // Calculate the start and end indices for the displayed questions
    $startIndex = ($currentPage - 1) * $questionsPerPage;
    $endIndex = min($startIndex + $questionsPerPage, $totalQuestions);

    // Render the questions page using a template
    ob_start();
    include __DIR__ . '/admin_templates/questions.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    // Handle database errors
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// Include the layout template for the admin panel
include __DIR__ . '/admin_templates/layout.html.php';
?>
