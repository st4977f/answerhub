<?php
    include __DIR__ . '/includes/DatabaseConnection.php';
$title = 'Page Not Found';

// Start the session
session_start();

// Page not found for the user space
if ( isset( $_SESSION[ 'username' ] ) ) {
    try {
        // Check if REDIRECT_STATUS is set
        if ( isset( $_SERVER[ 'REDIRECT_STATUS' ] ) ) {
            $error = $_SERVER[ 'REDIRECT_STATUS' ];
            $error_title = '';
            $error_message = '';

            if ( $error == 404 ) {
                $error_title = '404 Page Not Found';
                $error_message = 'The document/file requested was not found';
            }
        } else {
            $error_title = '404 Page Not Found';
            $error_message = 'The document/file requested was not found';
        }

        ob_start();
        include 'templates/404.html.php';
        $output = ob_get_clean();
    } catch ( PDOException $e ) {
        $title = 'An error has occurred';
        $output = 'Error: ' . $e->getMessage();
    }
    include 'user/user_templates/user_layout.html.php';

// Page not found for the admin space

} elseif ( strpos( $_SERVER[ 'REQUEST_URI' ], '/admin/' ) !== false ) {
    try {
        // Check if REDIRECT_STATUS is set
        if ( isset( $_SERVER[ 'REDIRECT_STATUS' ] ) ) {
            $error = $_SERVER[ 'REDIRECT_STATUS' ];
            $error_title = '';
            $error_message = '';

            if ( $error == 404 ) {
                $error_title = '404 Page Not Found';
                $error_message = 'The document/file requested was not found';
            }
        } else {
            $error_title = '404 Page Not Found';
            $error_message = 'The document/file requested was not found';
        }
        ob_start();
        include 'admin/admin_templates/404.html.php';
        $output = ob_get_clean();
    } catch ( PDOException $e ) {
        $title = 'An error has occurred';
        $output = 'Error: ' . $e->getMessage();
    }

    // Include the regular layout template
    include 'admin/admin_templates/layout.html.php';

// Page not found for the public space
} else {
    try {
        // Check if REDIRECT_STATUS is set
        if ( isset( $_SERVER[ 'REDIRECT_STATUS' ] ) ) {
            $error = $_SERVER[ 'REDIRECT_STATUS' ];
            $error_title = '';
            $error_message = '';

            if ( $error == 404 ) {
                $error_title = '404 Page Not Found';
                $error_message = 'The document/file requested was not found';
            }
        } else {
            $error_title = '404 Page Not Found';
            $error_message = 'The document/file requested was not found';
        }

        ob_start();
        include './templates/404.html.php';
        $output = ob_get_clean();
    } catch ( PDOException $e ) {
        $title = 'An error has occurred';
        $output = 'Error: ' . $e->getMessage();
    }

    // Include the regular layout template
    include './templates/layout.html.php';
}

?>
