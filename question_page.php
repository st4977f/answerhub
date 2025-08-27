<?php
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php';
    include __DIR__ . '/includes/redirect_logged_users.php';

    // Redirect logged-in users to their user area
    redirectLoggedInUsers();
    
try {
    // Check if ID parameter is provided
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $title = 'Page Not Found';
        $error_title = '404 Page Not Found';
        $error_message = 'Question ID is required';
        
        ob_start();
        include __DIR__ . 'templates/404.html.php';
        $output = ob_get_clean();
    } else {
        $questionId = $_GET['id'];
        $question = getQuestion($pdo, $questionId);

        // Check if question exists before trying to access its properties
        if ($question === false) {
            $title = 'Page Not Found';
            $error_title = '404 Page Not Found';
            $error_message = 'The requested question was not found';
            
            ob_start();
            include __DIR__ .'templates/404.html.php';
            $output = ob_get_clean();
        } else {
            $title = $question['questiontitle'];
            $user = getUser($pdo, $question['userid']);
            $answers = getAnswers($pdo, $questionId);

            addAnswer($pdo);

            ob_start();
            include __DIR__ . 'templates/question_page.html.php';
            $output = ob_get_clean();
        }
    }

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error retrieving question: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include __DIR__ . 'templates/layout.html.php';
?>