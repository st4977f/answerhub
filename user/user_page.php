<?php
$title = 'User Profile';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

// Get the user ID from the URL parameter and set the title accordingly

try {
    $title = 'User Profile: ' . htmlspecialchars( $_GET[ 'id' ] );

    // Get the user information from the database
    $user = getUserInformation( $pdo, $_GET[ 'id' ] );
    
    if ($user === false) {
        header("Location: ../404.php");
        exit;
    }
    
    // Get questions and answers after confirming user exists
    $questions = getUserQuestions( $pdo, $user[ 'id' ] );
    $answers = getUserAnswers( $pdo, $user[ 'id' ] );

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
    $currentPageURL = $_SERVER['PHP_SELF']; // Get the current URL

    // Render the user profile page using a template
    ob_start();
    include __DIR__ . '/user_templates/user_page.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'User Profile';
    $output = 'Database error: ' . $e->getMessage();
}

// Include the layout template for the admin panel
include __DIR__ . '/user_templates/user_layout.html.php';
    ?>