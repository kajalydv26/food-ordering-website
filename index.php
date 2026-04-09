<?php
// Start session for cart functionality
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Restaurant</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="toast" class="toast"></div>

  <!-- Header -->
  <header id="home">
    <h1>🍽 Welcome foodies</h1>
    <p>Delicious Food • Cozy Atmosphere • Great Service</p>
    <nav>
      <a href="#home">Home</a>
      <a href="#menu">Menu</a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
      <a href="cart.php">Orders</a>
    </nav>
  </header>

  <!-- Home Section -->
<section class="Welcome">
  <h2>Welcome</h2>
  🍕 Fresh Food | 🍔 Fast Service | 🥤 Cool Drinks <br>
Delicious meals made with passion, served with love.</p>
<p>Experience the perfect blend of taste and quality. From cheesy pizzas to refreshing drinks, we bring you the best flavors in town. We are committed to delivering fresh, hygienic, and delicious food using the finest ingredients. Your satisfaction is our priority.</p>
</section>

  <!-- Special Offers Section -->
<section style="background: #ffebee;">
    <h2>🎉 Special Offers & Discounts</h2>
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 30px;">
        <div style="background: white; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h3 style="color: #b22222;">🍕 Pizza Special</h3>
            <p>Buy 1 Pizza, Get 20% Off</p>
            <p style="font-weight: bold; color: #b22222; font-size: 1.2em;">Use Code: PIZZA20</p>
        </div>
        <div style="background: white; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h3 style="color: #b22222;">🍔 Burger Combo</h3>
            <p>2 Burgers + 1 Drink = ₹299 Only</p>
            <p style="font-weight: bold; color: #b22222; font-size: 1.2em;">Use Code: COMBO299</p>
        </div>
        <div style="background: white; padding: 20px; border-radius: 10px; width: 250px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h3 style="color: #b22222;">🎊 Weekend Fest</h3>
            <p>All Orders Above ₹500 Get 15% Off</p>
            <p style="font-weight: bold; color: #b22222; font-size: 1.2em;">Use Code: WEEKEND15</p>
        </div>
    </div>
</section>

  <!-- Menu Section -->
<section id="menu" class="menu">
    <h2>Our Menu</h2>

    <!-- FILTER BUTTONS -->
    <div class="buttons">
        <button onclick="filterMenu('all')">All</button>
        <button onclick="filterMenu('pizza')">Pizza</button>
        <button onclick="filterMenu('burger')">Burger</button>
        <button onclick="filterMenu('drink')">Drinks</button>
        <button onclick="filterMenu('snack')">Snacks</button>
        <button onclick="filterMenu('dessert')">Dessert</button>
        <button onclick="filterMenu('indian')">Indian foods</button>
        <button onclick="filterMenu('pasta')">Pasta</button>
    </div>

    <div class="menu-container">
        <?php
        include 'db.php';
        $result = $conn->query("SELECT * FROM menu ORDER BY category, name");
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menu-card ' . $row['category'] . '">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<b>₹' . number_format($row['price'], 2) . '</b><br>';
            echo '<button onclick="addToCart(' . $row['id'] . ', \'' . addslashes($row['name']) . '\', ' . $row['price'] . ')">Add</button>';
            echo '</div>';
        }
        ?>
    </div>
</section>

  <!-- About Section -->
  <section id="about">
    <h2>About Us</h2>
    <p>Founded in 2020, our restaurant is dedicated to serving delicious meals that bring people together. Our chefs are passionate about creating unique flavors, and our team is committed to providing warm and welcoming service.</p>
  </section>

  <!-- Contact Section -->
  <section id="contact">
    <h2>Contact Us</h2>
    <p>📍 Address: Main Street, City</p>
    <p>📞 Phone: +91 9876543210</p>
    <p>✉️ Email: info@foodies.com</p>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 foodies | All Rights Reserved</p>
    <p>Follow us on 🍴 Instagram | 👍 Facebook</p>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>