<?php
// Simple test to see what's in your database
include __DIR__ . '/../includes/DatabaseConnection.php';

try {
    echo "<h2>Quick Database Check</h2>";
    
    // Check if question table exists and has data
    $stmt = $pdo->query("SELECT id, questiontitle FROM question ORDER BY id LIMIT 10");
    $questions = $stmt->fetchAll();
    
    echo "<h3>Questions in database:</h3>";
    if (empty($questions)) {
        echo "<p>No questions found in database!</p>";
    } else {
        echo "<ul>";
        foreach ($questions as $q) {
            echo "<li>ID: {$q['id']} - Title: " . htmlspecialchars($q['questiontitle']) . "</li>";
        }
        echo "</ul>";
    }
    
    // Test specific question ID 1
    echo "<h3>Test for Question ID 1:</h3>";
    $stmt1 = $pdo->prepare("SELECT * FROM question WHERE id = 1");
    $stmt1->execute();
    $q1 = $stmt1->fetch();
    
    if ($q1) {
        echo "<p>✅ Question ID 1 EXISTS</p>";
        echo "<p>Title: " . htmlspecialchars($q1['questiontitle']) . "</p>";
        echo "<p>User ID: " . $q1['userid'] . "</p>";
        echo "<p>Category ID: " . $q1['categoryid'] . "</p>";
    } else {
        echo "<p>❌ Question ID 1 does NOT exist</p>";
    }
    
} catch (Exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
