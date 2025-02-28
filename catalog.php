<?php
require_once 'db.php';       // Include database connection
require_once 'functions.php';// Include session and helper functions
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Catalog - ACME Store</title>
<link rel="stylesheet" href="css/style.css"> <!-- Include stylesheet -->
</head>
<body>
<?php include 'nav.php'; // Include navigation menu ?>
<main>
    <h1>Our Products</h1>
    <div class="product-grid">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM product ORDER BY name ASC");
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="product-card">';
                echo '<img src="img/' . e($product['image']) . '" alt="' . e($product['name']) . '">';
                echo '<h2>' . e($product['name']) . '</h2>';
                echo '<p>$' . number_format($product['price'], 2) . '</p>';
                echo '<a href="product.php?id=' . (int)$product['id'] . '">View Product Details</a>';
                echo '</div>';
            }
        } catch (Exception $e) {
            // If there's an error loading products, show an error message
            echo "<p class='error'>Unable to load products at this time.</p>";
        }
        ?>
    </div>
</main>

<footer>
    Background Image by Camila Xiao
</footer>

</body>
</html>
