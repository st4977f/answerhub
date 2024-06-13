<?php
$title = 'Admin Panel - Categories';

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
    // Call addCategory
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['addCategory'])) {
            $categoryName = $_POST['categoryName'];
            addCategory($pdo, $categoryName);
        }
    }

    // Fetch all categories from the database
    $categories = fetchAllCategories($pdo);

    // Render the categories page
    ob_start();
    include __DIR__ .  '/admin_templates/categories.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    // Handle database errors
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

// Include the layout template for the admin panel
include __DIR__ .  '/admin_templates/layout.html.php';
?>
