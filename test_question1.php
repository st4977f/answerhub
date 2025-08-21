<?php
include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';

echo "<h2>Testing Question ID 1 Access</h2>";

if (isset($_GET['id'])) {
    echo "<p>ID parameter: " . htmlspecialchars($_GET['id']) . "</p>";
    
    $question = getQuestion($pdo, $_GET['id']);
    if ($question) {
        echo "<h3>✅ Question found!</h3>";
        echo "<p>Title: " . htmlspecialchars($question['questiontitle']) . "</p>";
        echo "<p>User ID: " . $question['userid'] . "</p>";
        echo "<p>Category: " . $question['categoryname'] . "</p>";
    } else {
        echo "<h3>❌ Question not found</h3>";
    }
} else {
    echo "<p>No ID parameter provided</p>";
}

echo '<br><a href="?id=1">Test with ID=1</a>';
echo '<br><a href="?id=2">Test with ID=2</a>';
echo '<br><a href="?id=3">Test with ID=3</a>';
?>
