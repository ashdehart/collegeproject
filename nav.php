<?php
require_once 'functions.php';
?>
<nav class="main-nav">
    <ul class="left-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="catalog.php">Catalog</a></li>
    </ul>
    <ul class="right-links">
        <?php if (!isLoggedIn()): ?>
            <li><a href="index.php">Log In</a></li>
            <li><a href="create-account.php">Create Account</a></li>
        <?php else: ?>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="logout.php">Log Out</a></li>
        <?php endif; ?>
    </ul>
</nav>
