<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    $questionId = $_GET['id'];
    $question = getQuestion($pdo, $questionId);
    $title = $question['questiontitle'];
    $user = getUser($pdo, $question['userid']);
    $answers = getAnswers($pdo, $questionId);
    
    if ($question === false) {
        header("Location: ../404.php");
        exit;
    }
    
    addAnswer($pdo);

    ob_start();
    include __DIR__ . '/user_templates/question_page.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error retrieving question: ' . $e->getMessage();
}

include __DIR__ . '/user_templates/user_layout.html.php';
?>

