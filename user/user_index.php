<?php
$title = 'Dashboard - AnswerHub';
include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
    $username = $_SESSION['username'];
    
    // Get user information
    $user = getUserInformation($pdo, $username);
    
    if (!$user) {
        header("Location: ../login");
        exit;
    }
    
    // Get user's questions and answers
    $userQuestions = getUserQuestions($pdo, $user['id']);
    $userAnswers = getUserAnswers($pdo, $user['id']);
    
    // Get recent questions from the community (last 5)
    $recentQuestions = getQuestions($pdo);
    $recentQuestions = array_slice($recentQuestions, 0, 5);
    
    // Get user statistics
    $totalQuestions = count($userQuestions);
    $totalAnswers = count($userAnswers);
    
    // Get recent activity (user's latest questions)
    $recentUserQuestions = array_slice($userQuestions, 0, 3);

    ob_start();
    include __DIR__ . '/user_templates/user_home.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Dashboard - Error';
    $output = 'Error loading dashboard: ' . $e->getMessage();
}

include __DIR__ . '/user_templates/user_layout.html.php';
?>