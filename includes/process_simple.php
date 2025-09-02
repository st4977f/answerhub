<?php
// Simple process file for debugging
include __DIR__ . '/session.php';
include __DIR__ . '/DatabaseConnection.php';

// Login
if (isset($_POST['login'])) {
    $username = trim(strip_tags($_POST['uid']));
    $password = trim($_POST['pwd']);

    if (empty($username) || empty($password)) {
        echo "All fields are required.";
        echo "<br/>";
        echo "<a href='/login'>Go Back</a>";
        exit();
    }

    try {
        $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(":username", $username);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: /user/user_index");
            exit();
        } else {
            header("Location: /incorrect.php");
            exit();
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        exit();
    }
}

// Registration
if (isset($_POST['submit'])) {
    $username = trim(strip_tags($_POST['uid']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim($_POST['pwd']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        echo "<br/>";
        echo "<a href='/registration'>Go Back</a>";
        exit();
    }

    try {
        // Check if username exists
        $checkUser = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $checkUser->bindParam(":username", $username);
        $checkUser->execute();

        if ($checkUser->rowCount() > 0) {
            echo "Username already exists.";
            echo "<br/>";
            echo "<a href='/registration'>Go Back</a>";
            exit();
        }

        // Check if email exists
        $checkEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmail->bindParam(":email", $email);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            echo "Email already exists.";
            echo "<br/>";
            echo "<a href='/registration'>Go Back</a>";
            exit();
        }

        // Insert new user
        $query = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query->bindParam(":password", $hashedPassword);

        if ($query->execute()) {
            $_SESSION['username'] = $username;
            header("Location: /user/user_index");
            exit();
        } else {
            echo "Registration failed.";
            echo "<br/>";
            echo "<a href='/registration'>Go Back</a>";
            exit();
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
        exit();
    }
}

echo "No valid request received.";
echo "<br/>";
echo "<a href='/'>Go Home</a>";
?>
