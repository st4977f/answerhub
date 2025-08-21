<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

// NO session check - this is for testing only

try {
    // Check if ID parameter is provided
    if (!isset($_GET['id']) || empty($_GET['id']) || trim($_GET['id']) === '') {
        echo '<h1>Error: Question ID is required</h1>';
        echo '<a href="?id=1">Test with ID=1</a>';
        exit;
    }
    
    $questionId = $_GET['id'];
    echo "<h2>Testing Question Page for ID: $questionId</h2>";
    
    $question = getQuestion($pdo, $questionId);
    
    if ($question === false) {
        echo "<h3>❌ Question not found</h3>";
        echo "<p>Question ID {$questionId} was not found.</p>";
    } else {
        echo "<h3>✅ Question found!</h3>";
        echo "<p><strong>Title:</strong> " . htmlspecialchars($question['questiontitle']) . "</p>";
        echo "<p><strong>Content:</strong> " . htmlspecialchars($question['questiontext']) . "</p>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($question['username']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($question['categoryname']) . "</p>";
        echo "<p><strong>Date:</strong> " . $question['questiondate'] . "</p>";
        
        // Try to get answers
        $answers = getAnswers($pdo, $questionId);
        echo "<h4>Answers (" . count($answers) . ")</h4>";
        foreach ($answers as $answer) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
            echo "<p>" . htmlspecialchars($answer['answertext']) . "</p>";
            echo "<small>By: " . htmlspecialchars($answer['username']) . " on " . $answer['answerdate'] . "</small>";
            echo "</div>";
        }
    }

} catch (Exception $e) {
    echo '<h3>Error:</h3>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
}

echo '<br><br><a href="?id=1">Test ID=1</a> | <a href="?id=2">Test ID=2</a> | <a href="?id=3">Test ID=3</a>';
?>
