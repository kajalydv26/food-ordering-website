// Function to add item to cart
function addToCart(itemId, name, price) {
    // Send AJAX request to add_to_cart.php
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'item_id=' + itemId + '&name=' + encodeURIComponent(name) + '&price=' + price
    })
    .then(response => response.text())
    .then(data => {
        showToast(data); // Show inline success message
        // Optionally, update cart count or redirect to cart
    })
    .catch(error => {
        showToast('Error adding item to cart.');
        console.error('Error:', error);
    });
}

function showToast(message) {
    const toast = document.getElementById('toast');
    if (!toast) {
        alert(message);
        return;
    }
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(() => toast.classList.remove('show'), 3000);
}

// Function to filter menu items
function filterMenu(category) {
    let items = document.querySelectorAll('.menu-card');

    items.forEach(item => {
        if (category === 'all' || item.classList.contains(category)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}

// Function to remove item from cart
function removeFromCart(itemId) {
    if (confirm('Are you sure you want to remove this item?')) {
        window.location.href = 'cart.php?remove=' + itemId;
    }
}