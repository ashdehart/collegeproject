<?php
require_once 'db.php';       // Include database connection
require_once 'functions.php';// Include session and helper functions

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    $verify_password = $_POST['verify_password'] ?? '';

    if (empty($username) || empty($password) || empty($verify_password)) {
        $error = "All fields are required.";
    } elseif ($password !== $verify_password) {
        $error = "Passwords do not match.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM user WHERE username = ?");
            $stmt->execute([$username]);

            if ($stmt->fetch()) {
                $error = "Username already exists.";
            } else {
                $hashed = password_hash($password, PASSWORD_BCRYPT);
                $insert = $pdo->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
                $insert->execute([$username, $hashed]);

                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            $error = "An error occurred. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account - ACME Store</title>
<link rel="stylesheet" href="css/style.css"> <!-- Include stylesheet -->
<script src="js/script.js" defer></script> <!-- Include JS for form validation -->
</head>
<body>
<?php include 'nav.php'; // Include navigation bar ?>

<div class="page-container">
    <!-- main with create-account-page class -->
    <main class="create-account-page">
        <form action="" method="post" id="createAccountForm" class="form-container">
            <h1>Create Account</h1>
            <?php if(!empty($error)): ?>
                <p class="error"><?php echo e($error); ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label for="ca_username">Username:</label>
                <input type="text" name="username" id="ca_username" required>
            </div>

            <div class="form-group">
                <label for="ca_password">Password:</label>
                <input type="password" name="password" id="ca_password" required>
                <p id="passwordHelp" class="help"></p>
            </div>

            <div class="form-group">
                <label for="ca_verify_password">Verify Password:</label>
                <input type="password" name="verify_password" id="ca_verify_password" required>
                <p id="verifyHelp" class="help"></p>
            </div>

            <div class="form-actions">
                <button type="reset">Reset</button>
                <button type="submit" id="createAccountBtn" disabled>Create Account</button>
            </div>
        </form>
    </main>
</div>

<footer>
    Background Image by Camila Xiao
</footer>

</body>
</html>
