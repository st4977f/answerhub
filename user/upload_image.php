<?php
$title = 'Image Upload Error';
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

include __DIR__ . '/../includes/session.php';
include __DIR__ . '/../includes/check_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'profileImage' file is set and there were no errors during upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['profileImage'];
        // Call the function to handle the image upload
        uploadProfileImage($pdo, $_SESSION['username'], $image);
    } else {
        // If no image was uploaded or an error occurred, set the error message
        $uploadError = "No image uploaded or an error occurred during upload.";
        // Redirect the user to the profile page with the error message as a URL parameter
        header('Location: profile.php?error=' . urlencode($uploadError));
        exit();
    }
}
// Redirect the user back to the profile page after processing the upload or in case of an error
header('Location: profile.php');
exit();
?>
