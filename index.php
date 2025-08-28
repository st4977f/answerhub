<?php
$title = 'AnswerHub - Ask, Answer, Learn';

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';
include __DIR__ . '/includes/redirect_logged_users.php';

// Redirect logged-in users to their user area
redirectLoggedInUsers();

try {
    // Get statistics for the homepage
    $totalQuestions = totalQuestions($pdo);
    $totalAnswers = 0;
    $totalUsers = 0;
    $totalCategories = 0;
    
    // Get total answers count
    $answerQuery = $pdo->query('SELECT COUNT(*) FROM answer');
    $totalAnswers = $answerQuery->fetchColumn();
    
    // Get total users count
    $userQuery = $pdo->query('SELECT COUNT(*) FROM users');
    $totalUsers = $userQuery->fetchColumn();
    
    // Get total categories count
    $categoryQuery = $pdo->query('SELECT COUNT(*) FROM category');
    $totalCategories = $categoryQuery->fetchColumn();
    
    // Get recent questions (latest 5)
    $recentQuestions = getQuestions($pdo);
    $recentQuestions = array_slice($recentQuestions, 0, 5);
    
    // Get popular categories with question counts
    $popularCategoriesQuery = $pdo->query('
        SELECT c.id, c.categoryName, COUNT(q.id) as question_count 
        FROM category c 
        LEFT JOIN question q ON c.id = q.categoryid 
        GROUP BY c.id, c.categoryName 
        ORDER BY question_count DESC, c.categoryName ASC
    ');
    $popularCategories = $popularCategoriesQuery->fetchAll(PDO::FETCH_ASSOC);

    ob_start();
    include __DIR__ . 'templates/home.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include __DIR__ . '/templates/layout.html.php';
?>