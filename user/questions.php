<?php
$title = 'List of Questions';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    $questions = getQuestions( $pdo );
    $totalQuestions = totalQuestions( $pdo );
    $totalAnswers = totalAnswers( $pdo, 'id' );

    $questionsPerPage = 15;
    // Maximum questions per page
    $totalPages = ceil( $totalQuestions / $questionsPerPage );
    // Total number of pages

    if ( isset( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ) {
        $currentPage = $_GET[ 'page' ];
    } else {
        $currentPage = 1;
    }

    $startIndex = ( $currentPage - 1 ) * $questionsPerPage;
    $endIndex = min( $startIndex + $questionsPerPage, $totalQuestions );

    ob_start();
    include __DIR__ . '/../user/user_templates/questions.html.php';
    $output = ob_get_clean();
} catch ( PDOException $e ) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include __DIR__ . '/../user/user_templates/user_layout.html.php';
?>