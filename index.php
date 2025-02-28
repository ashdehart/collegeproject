<?php
require_once 'db.php';       // Include database connection
require_once 'functions.php';// Include session and helper functions

$message = "";

if (isLoggedIn()) {
    // If already logged in, no login form is shown, just a welcome message.
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle login attempts
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $message = "Please fill in all fields.";
        } else {
            try {
                $stmt = $pdo->prepare("SELECT id, username, password FROM user WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    // Successful login
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['username'];
                    header("Location: index.php");
                    exit;
                } else {
                    $message = "Invalid username or password.";
                }
            } catch (Exception $e) {
                // error message on exception
                $message = "An error occurred. Please try again later.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ACME Store - Home</title>
<link rel="stylesheet" href="css/style.css"> <!-- Include stylesheet -->
</head>
<body>
<?php include 'nav.php'; // Include navigation bar ?>

<div class="page-container">
<main>
    <?php if (isLoggedIn()): ?>
        <h1>Welcome to Our Store, <?php echo e($_SESSION['username']); ?>!</h1>
        <p>Feel free to browse our products and add them to your cart.</p>
    <?php else: ?>
        <h1>Welcome to the ACME Store</h1>
        <p>Please log in to continue.</p>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <?php if(!empty($message)): ?>
                <p class="error"><?php echo e($message); ?></p>
            <?php endif; ?>

            <button type="submit">Log In</button>
        </form>

        <p>Don't have an account? <a href="create-account.php">Create one here</a>.</p>
    <?php endif; ?>
</main>
</div>

<footer>
    Background Image by Camila Xiao
</footer>

</body>
</html>
