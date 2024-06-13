<?php

// Database connection details
$dsn = 'mysql:host=sql112.infinityfree.com;dbname=if0_36672975_answerhub;charset=utf8mb4';
$username = 'if0_36672975';
$password = 'sSdqUv1h3V';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
