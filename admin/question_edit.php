<?php
$title = 'Edit Question';

// Include necessary files
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
    // Handle form submission for editing a question
    if (isset($_POST['questiontext'])) {
        $questionId = $_POST['id'];
        editQuestion($pdo);
    } else {
        // Fetch the question data for editing
        $questionId = $_GET['id'];
        $question = fetchQuestion($pdo, $questionId);

        // Render the question edit page using a template
        ob_start();
        include __DIR__ .  '/admin_templates/question_edit.html.php';
        $output = ob_get_clean();
    }

} catch (PDOException $e) {
    // Handle database errors
    $title = 'An error has occurred';
    $output = 'Error editing question: ' . $e->getMessage();
}

// Include the layout template for the admin panel
include __DIR__ .  '/admin_templates/layout.html.php';
?>
