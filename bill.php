<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if (!isset($_GET['order_id'])) {
    header('Location: index.php');
    exit();
}

$order_id = $_GET['order_id'];

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();
$stmt->close();

if (!$order) {
    echo "Order not found!";
    exit();
}

// Fetch order items
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items_result = $stmt->get_result();
$items = $items_result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill - My Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>🍽 My Restaurant - Order Receipt</h1>
    </header>

    <section>
        <div class="bill-container">
            <?php if (isset($_GET['placed']) && $_GET['placed'] == '1'): ?>
                <div class="order-success">✅ Your order has been placed successfully!</div>
            <?php endif; ?>

            <div class="bill-header">
                <h2>Order Receipt</h2>
                <p>Order ID: #<?php echo $order['order_id']; ?></p>
                <p>Date: <?php echo date('Y-m-d H:i:s', strtotime($order['order_date'])); ?></p>
            </div>

            <div>
                <p><strong>Customer Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
                <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['customer_address']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['customer_phone']); ?></p>
                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
            </div>

            <hr>

            <h3>Items Ordered:</h3>
            <?php foreach ($items as $item): ?>
                <div class="bill-item">
                    <span><?php echo htmlspecialchars($item['item_name']); ?> (x<?php echo $item['quantity']; ?>)</span>
                    <span>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endforeach; ?>

            <hr>

            <div class="bill-total">
                <strong>Total Amount: ₹<?php echo number_format($order['total_price'], 2); ?></strong>
            </div>

            <p style="text-align: center; margin-top: 20px;">
                Thank you for your order! Your food will be prepared shortly.
            </p>

            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php"><button style="padding: 10px 20px; background: darkred; color: white; border: none; border-radius: 5px; cursor: pointer;">Order Again</button></a>
            </div>
        </div>
    </section>

    <script>
        // Auto print the bill
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>