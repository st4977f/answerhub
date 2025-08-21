<?php
// Start session first
include __DIR__ . '/session.php';
include __DIR__ . '/DatabaseConnection.php';
include __DIR__ . '/security.php';

// Set security headers
setSecurityHeaders();

// Registration
if (isset($_POST['submit'])) {
    $username = sanitizeString($_POST['uid']);
    $email = sanitizeString($_POST['email']);
    $password = sanitizePassword($_POST['pwd']);

    // Validate input
    $validationErrors = validateInput($username, $email, $password);
    
    if (!empty($validationErrors)) {
        echo "<div style='color: red;'>";
        echo "<h3>Validation Errors:</h3>";
        foreach ($validationErrors as $error) {
            echo "<p>• " . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
        }
        echo "<br/><a href='../registration'>Go Back</a>";
        echo "</div>";
        return;
    }

    if (checkUserExists($pdo, $username)) {
        echo "Username Already Exists";
        echo "<br/>";
        echo "<a href='../registration'>Go Back</a>";
        return;
    }

    if (checkEmailExists($pdo, $email)) {
        echo "Email Already Exists";
        echo "<br/>";
        echo "<a href='../registration'>Go Back</a>";
        return;
    }

    if (insertDetails($pdo, $username, $email, $password)) {
        $_SESSION['username'] = $username;
        header("Location: ../user/user_index");
        exit();
    } else {
        echo "Registration failed.";
        echo "<br/>";
        echo "<a href='../registration'>Go Back</a>";
    }
}

// Login
if (isset($_POST['login'])) {
    $username = sanitizeString($_POST['uid']);
    $password = sanitizePassword($_POST['pwd']);
    $clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    // Rate limiting check
    if (!checkRateLimit($clientIP . '_login', 5, 300)) {
        logSecurityEvent('RATE_LIMIT_EXCEEDED', "Login attempts from IP: {$clientIP}");
        echo "Too many login attempts. Please try again in 5 minutes.";
        echo "<br/>";
        echo "<a href='../login'>Go Back</a>";
        return;
    }

    if (empty($username) || empty($password)) {
        logSecurityEvent('INVALID_LOGIN_ATTEMPT', "Empty credentials from IP: {$clientIP}");
        echo "All fields are required.";
        echo "<br/>";
        echo "<a href='../login'>Go Back</a>";
        return;
    }
    
    // Additional validation for login
    if (strlen($username) > 50 || strlen($password) > 255) {
        logSecurityEvent('INVALID_LOGIN_ATTEMPT', "Invalid credentials length from IP: {$clientIP}");
        echo "Invalid credentials.";
        echo "<br/>";
        echo "<a href='../login'>Go Back</a>";
        return;
    }

    if (checkLogin($pdo, $username, $password)) {
        logSecurityEvent('SUCCESSFUL_LOGIN', "User: {$username} from IP: {$clientIP}");
        $_SESSION['username'] = $username;
        header("Location: ../user/user_index");
        exit();
    } else {
        logSecurityEvent('FAILED_LOGIN_ATTEMPT', "User: {$username} from IP: {$clientIP}");
        header("Location: ../incorrect.php");
        exit();
    }
}

// Functions
function insertDetails($pdo, $username, $email, $password) {
    try {
        $query = $pdo->prepare("
            INSERT INTO users (username, email, password)
            VALUES(:username, :email, :password)
        ");

        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query->bindParam(":password", $hashedPassword);

        return $query->execute();
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        return false;
    }
}

function checkLogin($pdo, $username, $password) {
    try {
        $query = $pdo->prepare("
            SELECT * FROM users WHERE username=:username
        ");

        $query->bindParam(":username", $username);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        return false;
    }
}

function sanitizeString($string) {
    // Remove HTML tags, trim whitespace, and convert special characters
    $string = trim($string);
    $string = strip_tags($string);
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    
    // Additional protection against common injection patterns
    $string = preg_replace('/[<>"\']/', '', $string);
    
    return $string;
}

function sanitizePassword($string) {
    // Only trim for passwords, don't alter the actual content
    return trim($string);
}

function validateInput($username, $email, $password) {
    $errors = [];
    
    // Username validation
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = "Username must be between 3 and 50 characters";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }
    
    // Email validation
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } elseif (strlen($email) > 100) {
        $errors[] = "Email is too long";
    }
    
    // Password validation
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    } elseif (strlen($password) > 255) {
        $errors[] = "Password is too long";
    }
    
    return $errors;
}

function checkUserExists($pdo, $username) {
    try {
        $query = $pdo->prepare("
            SELECT * FROM users WHERE username=:username
        ");

        $query->bindParam(":username", $username);
        $query->execute();

        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        return false;
    }
}

function checkEmailExists($pdo, $email) {
    try {
        $query = $pdo->prepare("
            SELECT * FROM users WHERE email=:email
        ");

        $query->bindParam(":email", $email);
        $query->execute();

        return $query->rowCount() > 0;
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        return false;
    }
}
?>
