<?php
// Enable error reporting
ob_start();

include __DIR__ . '/session.php';
include __DIR__ . '/DatabaseConnection.php';

// Registration
if (isset($_POST['submit'])) {
    $username = sanitizeString($_POST['uid']);
    $email = sanitizeString($_POST['email']);
    $password = sanitizePassword($_POST['pwd']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        echo "<br/>";
        echo "<a href='registration.php'>Go Back</a>";
        return;
    }

    if (checkUserExists($pdo, $username)) {
        echo "Username Already Exists";
        echo "<br/>";
        echo "<a href='../registration.php'>Go Back</a>";
        return;
    }

    if (checkEmailExists($pdo, $email)) {
        echo "Email Already Exists";
        echo "<br/>";
        echo "<a href='../registration.php'>Go Back</a>";
        return;
    }

    if (insertDetails($pdo, $username, $email, $password)) {
        $_SESSION['username'] = $username;
        header("Location: /user/user_index.php");
        exit();
    } else {
        echo "Registration failed.";
        echo "<br/>";
        echo "<a href='../registration.php'>Go Back</a>";
    }
}

// Login
if (isset($_POST['login'])) {
    $username = sanitizeString($_POST['uid']);
    $password = $_POST['pwd'];

    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        echo "<br/>";
        echo "<a href='login.php'>Go Back</a>";
        return;
    }

    if (checkLogin($pdo, $username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: /user/user_index.php");
        exit();
    } else {
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
    return htmlspecialchars(strip_tags(trim($string)));
}

function sanitizePassword($string) {
    return trim($string);
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
