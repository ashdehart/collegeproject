<?php
require_once 'db.php';       // Include database connection
require_once 'functions.php';// Include session and helper functions
requireLogin();              // Ensure user is logged in to access the cart

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        // Handle cart updates
        if (isset($_POST['qty']) && is_array($_POST['qty'])) {
            foreach ($_POST['qty'] as $pid => $q) {
                $pid = (int)$pid;
                $q = filter_var($q, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
                
                // If invalid quantity, skip
                if ($q === false) {
                    continue;
                }

                if ($q <= 0) {
                    // Remove item from cart if quantity set to 0
                    unset($_SESSION['cart'][$pid]);
                } else {
                    // Update the quantity if item exists
                    if (isset($_SESSION['cart'][$pid])) {
                        $_SESSION['cart'][$pid]['quantity'] = $q;
                    }
                }
            }
        }
    }

    if (isset($_POST['place_order'])) {
        // Place order: show thank you message and clear the cart
        if (!empty($_SESSION['cart'])) {
            $orderedItems = $_SESSION['cart'];
            $_SESSION['cart'] = [];
            $message = "Thank you for your order!<br>";
            $message .= "<ul>";
            foreach($orderedItems as $item) {
                $message .= "<li>" . e($item['name']) . " x " . (int)$item['quantity'] . " @ $" . number_format($item['price'], 2) . "</li>";
            }
            $message .= "</ul>";
        } else {
            $message = "Your cart is empty, nothing to place order for.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart - ACME Store</title>
<link rel="stylesheet" href="css/style.css"> <!-- Include the stylesheet -->
</head>
<body>
<?php include 'nav.php'; // Include navigation menu ?>
<div class="page-container">
<main>
    <h1>Your Shopping Cart</h1>
    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
    } else {
        if (empty($_SESSION['cart'])) {
            echo "<p>Your cart is empty.</p>";
        } else {
            echo "<form action='' method='post'>";
            echo "<table class='cart-table'>";
            echo "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";

            $total = 0;
            foreach ($_SESSION['cart'] as $pid => $item) {
                $lineTotal = $item['quantity'] * $item['price'];
                $total += $lineTotal;
                echo "<tr>";
                echo "<td>" . e($item['name']) . "</td>";
                echo "<td>$" . number_format($item['price'], 2) . "</td>";
                echo "<td><input type='number' name='qty[$pid]' value='" . (int)$item['quantity'] . "' min='0'></td>";
                echo "<td>$" . number_format($lineTotal, 2) . "</td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='3' style='text-align:right; font-weight:bold;'>Cart Total:</td><td>$" . number_format($total, 2) . "</td></tr>";
            echo "</table>";
            echo "<button type='submit' name='update_cart'>Update Cart</button>";
            echo "<button type='submit' name='place_order'>Place Order</button>";
            echo "</form>";
        }
    }
    ?>
</main>
</div>

<footer>
    Background Image by Camila Xiao
</footer>

</body>
</html>
