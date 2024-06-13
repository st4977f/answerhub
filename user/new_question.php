<?php
$title = 'New Question';

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    // Get all categories
    $categories = allCategories($pdo);

    // Process the form submission if it's a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        addQuestion($pdo);
    }

    // Render the new question form
    ob_start();
    include __DIR__ . '/../user/user_templates/new_question.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    // Handle any database errors
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// include __DIR__ .  the user layout template
include __DIR__ . '/../user/user_templates/user_layout.html.php';
