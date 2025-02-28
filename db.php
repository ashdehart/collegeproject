<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    // Local environment settings
    $host = "localhost";
    $user = "root";
    $pass = "REDACTED";
    $dbname = "user_db";
} else {
    // Remote environment settings
    $host = "REDACTED";
    $user = "REDACTED";
    $pass = "REDACTED";
    $dbname = "rkkhmyte_user_db";
}

try {
    // Create a new instance with given credentials
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // On connection failure, display a error.
    die("Database Connection Failed. Please try again later.");
}
