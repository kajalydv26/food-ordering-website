<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php';

// Check if cart exists
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header('Location: cart.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = trim($_POST['customer_name'] ?? '');
    $customer_address = trim($_POST['customer_address'] ?? '');
    $customer_phone = trim($_POST['customer_phone'] ?? '');
    $payment_method = trim($_POST['payment_method'] ?? '');

    if ($customer_name === '' || $customer_address === '' || $customer_phone === '' || $payment_method === '') {
        header('Location: checkout.php');
        exit();
    }

    if (!preg_match('/^[0-9]{10}$/', $customer_phone)) {
        header('Location: checkout.php');
        exit();
    }

    // Calculate total
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_address, customer_phone, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $customer_name, $customer_address, $customer_phone, $total, $payment_method);
    $stmt->execute();
    $order_id = $conn->insert_id;
    $stmt->close();

    // Insert order items
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $stmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    $stmt->close();

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to bill
    header('Location: bill.php?order_id=' . $order_id . '&placed=1');
    exit();
} else {
    header('Location: checkout.php');
    exit();
}
?>