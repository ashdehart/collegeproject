<?php
require_once 'db.php';        // Include database connection
require_once 'functions.php'; // Include session and helper functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("Invalid product ID.");
}

try {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id=?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("An error occurred while fetching the product.");
}

if (!$product) {
    die("Product not found.");
}

// Handle add to cart
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qty = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if ($qty === false || $qty <= 0) {
        // Invalid quantity
        $message = "Please enter a valid quantity.";
    } elseif (!isLoggedIn()) {
        // User not logged in
        $message = "Please <a href='index.php'>log in</a> first before adding to cart.";
    } else {
        // Add or update cart session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $qty
            ];
        }
        $message = "Product added to cart! <a href='cart.php'>View Cart</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo e($product['name']); ?> - ACME Store</title>
<link rel="stylesheet" href="css/style.css"> <!-- Include stylesheet -->
</head>
<body>
<?php include 'nav.php'; // Include navigation bar ?>

<main>
    <!-- Wrap product details in div for formatting -->
    <div class="product-detail">
        <img src="img/<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>">
        <h1><?php echo e($product['name']); ?></h1>
        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
        <p class="description"><?php echo e($product['description']); ?></p>

        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php else: ?>
            <form action="" method="post">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required>
                <button type="submit">Add to Cart</button>
            </form>
        <?php endif; ?>
    </div>
</main>

<footer>
    Background Image by Camila Xiao
</footer>

</body>
</html>
