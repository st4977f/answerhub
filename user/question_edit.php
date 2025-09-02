<?php
$title = 'Edit question';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        editQuestion($pdo);
    } else {
        $questionId = $_GET['id'];
        $username = strtolower($_SESSION['username']);
        // Verify if the logged-in user is the owner of the question
        $isOwner = verifyQuestionOwnership($pdo, $questionId, $username);
        if ($isOwner) {
            $question = fetchQuestion($pdo, $questionId);

            if ($question === false) {
                header("Location: ../404.php");
                exit;
            }

            $title = 'Edit question';

            ob_start();
            include __DIR__ . '/user_templates/question_edit.html.php';
            $output = ob_get_clean();
        } else {
            // Redirect the user if they are not the owner of the question
            header('location: question_edit?id=' . $questionId . '&error=not_owner');
            exit();
        }
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error editing question: ' . $e->getMessage();
}
include __DIR__ . '/user_templates/user_layout.html.php';
?>

