<?php
    $title = 'User List';
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php';
    include __DIR__ . '/includes/redirect_logged_users.php';

    // Redirect logged-in users to their user area
    redirectLoggedInUsers();
    
try {
    // Fetch all records and user questions from the database
    $results = fetchRecords($pdo);
    
    // Get total statistics
    $totalUsers = count( $results );
    $totalQuestionsInSystem = 0;
    $totalAnswersInSystem = 0;
    
    foreach ($results as $user) {
        $totalQuestionsInSystem += userQuestions($pdo, $user['id']);
        $totalAnswersInSystem += userAnswers($pdo, $user['id']);
    }
    
    // Filter users based on the filter parameter in the URL
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $results = filterUser($pdo, $filter);
    
    // Calculate pagination variables
    $filteredUsers = count( $results ); // Number of filtered users
    $usersPerPage = 12;  // Maximum users per page (reduced for better layout)
    $totalPages = ceil( $filteredUsers / $usersPerPage ); // Total number of pages

    if ( isset( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ) {
        $currentPage = $_GET[ 'page' ];
    } else {
        $currentPage = 1;
    }

    $startIndex = ( $currentPage - 1 ) * $usersPerPage;
    $endIndex = $startIndex + $usersPerPage;

    ob_start();
    include __DIR__ .'templates/userlist.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include __DIR__ . 'templates/layout.html.php';
?>