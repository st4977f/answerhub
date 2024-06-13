<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
    // Retrieve the question ID from the URL parameters
    $questionId = $_GET['id'];

    // Get the question, user, and answers data
    $question = getQuestion($pdo, $questionId);
    $title = $question['questiontitle'];
    $user = getUser($pdo, $question['userid']);
    $answers = getAnswers($pdo, $questionId);

    if ($question === false) {
        header("Location: ../admin/404.php");
        exit;
    }
    

    // Handle adding an answer to the question
    addAnswer($pdo);

    // Render the question page using a template
    ob_start();
    include __DIR__ . '/admin_templates/question_page.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    // Handle database errors
    $title = 'An error has occurred';
    $output = 'Error retrieving question: ' . $e->getMessage();
}

// Include the layout template for the admin panel
include __DIR__ . '/admin_templates/layout.html.php';
?>
