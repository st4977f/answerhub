<?php
$title = "List of Questions";

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';
include __DIR__ . '/includes/redirect_logged_users.php';

// Redirect logged-in users to their user area
redirectLoggedInUsers();

try {
    $questions = getQuestions($pdo);
    $totalQuestions = totalQuestions($pdo);
    $totalAnswers = totalAnswers($pdo, 'id');

    
    $questionsPerPage = 15;
    $totalPages = ceil( $totalQuestions / $questionsPerPage );
    if ( isset( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ) {
        $currentPage = $_GET[ 'page' ];
    } else {
        $currentPage = 1;
    }
    $startIndex = ( $currentPage - 1 ) * $questionsPerPage;
    $endIndex = min( $startIndex + $questionsPerPage, $totalQuestions );

    ob_start();
    include 'templates/questions.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';

?>