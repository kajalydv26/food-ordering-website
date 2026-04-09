<?php
session_start();
include 'db.php';

// Check if cart is empty
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header('Location: cart.php');
    exit();
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - My Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🍽 My Restaurant - Checkout</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="cart.php">Back to Orders</a>
        </nav>
    </header>

    <section>
        <div class="checkout-form">
            <h2>Checkout Details</h2>
            <form action="place_order.php" method="POST">
                <input type="text" name="customer_name" placeholder="Your Name" required>

                <input type="text" name="customer_address" placeholder="Delivery Address" required>

                <input type="tel" name="customer_phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required>

                <select name="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="cod">Cash on Delivery</option>
                    <option value="online">Online Payment</option>
                </select>

                <p><strong>Total Amount: ₹<?php echo number_format($total, 2); ?></strong></p>

                <button type="submit">Place Order</button>
            </form>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>
</html>