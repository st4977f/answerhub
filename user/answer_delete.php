<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

try {
    // Check if ID parameter is provided
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header('Location: user_index');
        exit();
    }

    $answerId = $_GET['id'];
    $answer = getAnswer($pdo, $answerId);

    // Check if answer exists
    if ($answer === false) {
        header('Location: user_index');
        exit();
    }

    // Check if current user owns this answer
    $currentUserId = getUserId($pdo, $_SESSION['username']);
    if ($answer['userid'] != $currentUserId) {
        header('Location: user_index');
        exit();
    }

    $title = 'Delete Answer';
    $questionId = $answer['questionid'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            $success = deleteAnswer($pdo, $answerId);
            
            if ($success) {
                header('Location: question_page?id=' . $questionId);
                exit();
            } else {
                $error = 'Failed to delete answer. Please try again.';
            }
        } else {
            header('Location: question_page?id=' . $questionId);
            exit();
        }
    }

    ob_start();
    include __DIR__ . '/user_templates/answer_delete.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include __DIR__ . '/user_templates/user_layout.html.php';
?>
