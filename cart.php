<?php
session_start();
include 'db.php';

// Handle item removal
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    // Reindex array
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit();
}

// Calculate total
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - My Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🍽 My Restaurant - Orders</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php#menu">Menu</a>
            <a href="cart.php">Orders</a>
        </nav>
    </header>

    <section class="cart-container">
        <h2>Your Orders</h2>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <div>
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Quantity: <?php echo $item['quantity']; ?> | Price: ₹<?php echo number_format($item['price'], 2); ?> each</p>
                    </div>
                    <div>
                        <p><strong>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong></p>
                        <button onclick="removeFromCart(<?php echo $item['id']; ?>)">Remove</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="cart-total">
                Total: ₹<?php echo number_format($total, 2); ?>
            </div>
            <a href="checkout.php"><button style="padding: 10px 20px; background: darkred; color: white; border: none; border-radius: 5px; cursor: pointer;">Proceed to Checkout</button></a>
        <?php else: ?>
            <p>Your cart is empty. <a href="index.php#menu">Go back to menu</a></p>
        <?php endif; ?>
    </section>

    <script src="js/script.js"></script>
</body>
</html>