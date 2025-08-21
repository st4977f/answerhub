<?php
// Include session management
include_once __DIR__ . '/session.php';

function redirectLoggedInUsers($redirectTo = null) {
    // Check if user is logged in
    if (isset($_SESSION['username'])) {
        
        // Default redirect mapping based on current page
        if ($redirectTo === null) {
            $currentScript = basename($_SERVER['SCRIPT_NAME'], '.php');
            
            // Map public pages to user area equivalents
            $redirectMap = [
                'index' => '/answerhub/user/user_index',
                'questions' => '/answerhub/user/questions.php',
                'userlist' => '/answerhub/user/userlist.php',
                'question_page' => '/answerhub/user/question_page.php',
                'user_page' => '/answerhub/user/user_page.php'
            ];
            
            // If there's a mapped user area page, redirect there
            if (isset($redirectMap[$currentScript])) {
                $redirectTo = $redirectMap[$currentScript];
            } else {
                // Default to user home if no specific mapping
                $redirectTo = '/answerhub/user/user_index';
            }
        }
        
        // Preserve query parameters for question pages
        if (isset($_GET['id']) && (strpos($redirectTo, 'question_page') !== false || strpos($redirectTo, 'user_page') !== false)) {
            $redirectTo .= '?id=' . $_GET['id'];
        }
        
        // Preserve pagination parameters
        if (isset($_GET['page']) && strpos($redirectTo, 'questions') !== false) {
            $redirectTo .= '?page=' . $_GET['page'];
        }
        
        // Perform the redirect
        header('Location: ' . $redirectTo);
        exit();
    }
}
?>
