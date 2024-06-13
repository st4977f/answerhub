<?php
    include __DIR__ . '/includes/DatabaseConnection.php';
    include __DIR__ . '/includes/DatabaseFunctions.php'; 
try {
    $questionId = $_GET['id'];
    $question = getQuestion($pdo, $questionId);
    $title = $question['questiontitle'];
    $user = getUser($pdo, $question['userid']);
    $answers = getAnswers($pdo, $questionId);

    if ($question === false) {
        header("HTTP/1.0 404 Not Found");
        include '404.php';
        exit;
    }

    addAnswer($pdo);

    ob_start();
    include 'templates/question_page.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error retrieving question: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>