<?php
    $title = 'User List';
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php'; 
try {
    $results = fetchRecords($pdo);
    $userQuestions = userQuestions($pdo, 'id');
    
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $results = filterUser($pdo, $filter);
    
    $totalUsers = count( $results );
    // Total number of users
    $usersPerPage = 36;
    // Maximum users per page
    $totalPages = ceil( $totalUsers / $usersPerPage );
    // Total number of pages

    if ( isset( $_GET[ 'page' ] ) && is_numeric( $_GET[ 'page' ] ) ) {
        $currentPage = $_GET[ 'page' ];
    } else {
        $currentPage = 1;
    }

    $startIndex = ( $currentPage - 1 ) * $usersPerPage;
    $endIndex = $startIndex + $usersPerPage;

    ob_start();
    include 'templates/userlist.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occured';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>