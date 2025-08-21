<?php
$title = 'User List';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    // Fetch all records and user questions from the database
    $results = fetchRecords( $pdo );
    
    // Get total statistics
    $totalUsers = count( $results );
    $totalQuestionsInSystem = 0;
    $totalAnswersInSystem = 0;
    
    foreach ($results as $user) {
        $totalQuestionsInSystem += userQuestions($pdo, $user['id']);
        $totalAnswersInSystem += userAnswers($pdo, $user['id']);
    }

    // Filter users based on the filter parameter in the URL
    $filter = isset( $_GET[ 'filter' ] ) ? $_GET[ 'filter' ] : '';
    $results = filterUser( $pdo, $filter );

    // Calculate pagination variables
    $filteredUsers = count( $results ); // Number of filtered users
    $usersPerPage = 12;  // Maximum users per page (reduced for better layout)
    $totalPages = ceil( $filteredUsers / $usersPerPage ); // Total number of pages
    
    // Determine the current page based on the URL parameters
    if ( isset( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ) {
        $currentPage = $_GET[ 'page' ];
    } else {
        $currentPage = 1;
    }

    $startIndex = ($currentPage - 1) * $usersPerPage; // Start index for the current page
    $endIndex = $startIndex + $usersPerPage; // End index for the current page

    // Render the user list page using a template
    ob_start();
    include __DIR__ . '/../user/user_templates/userlist.html.php';
    $output = ob_get_clean();

} catch ( PDOException $e ) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}

// Include the layout template for the admin panel

include __DIR__ . '/../user/user_templates/user_layout.html.php';
?>
