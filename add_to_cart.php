<?php
session_start();

// Include database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if item already in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $item_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // If not found, add new item
    if (!$found) {
        $_SESSION['cart'][] = array(
            'id' => $item_id,
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        );
    }

    echo "Item added";
} else {
    echo "Invalid request";
}
?>