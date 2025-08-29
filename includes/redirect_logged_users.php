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
                'index' => '/user/user_index',
                'questions' => '/user/questions.php',
                'userlist' => '/user/userlist.php',
                'question_page' => '/user/question_page.php',
                'user_page' => '/user/user_page.php'
            ];
            
            // If there's a mapped user area page, redirect there
            if (isset($redirectMap[$currentScript])) {
                $redirectTo = $redirectMap[$currentScript];
            } else {
                // Default to user home if no specific mapping
                $redirectTo = '/user/user_index';
            }
        }
        
        // Preserve query parameters for question pages
        if (isset($_GET['id']) && (strpos($redirectTo, 'question_page') !== false || strpos($redirectTo, 'user_page') !== false)) {
            $redirectTo .= '?id=' . $_GET['id'];
        }
        if (isset($_GET['page']) && strpos($redirectTo, 'questions') !== false) {
            $redirectTo .= '?page=' . $_GET['page'];
        }

        // Prevent redirect loop
        $currentUrl = $_SERVER['REQUEST_URI'];
        if ($currentUrl !== $redirectTo) {
            header('Location: ' . $redirectTo);
            exit();
        }
    }
}
?>
