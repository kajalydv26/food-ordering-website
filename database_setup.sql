-- Create database
CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

-- Create menu table
CREATE TABLE IF NOT EXISTS menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(50)
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_address VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create order_items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    item_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
);

-- Insert sample menu items
INSERT INTO menu (name, description, price, image, category) VALUES
('Pepperoni Pizza', 'Classic cheesy delight', 220.00, 'https://images.unsplash.com/photo-1542282811-943ef1a977c3?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'pizza'),
('Margherita Pizza', 'Classic Italian delight', 200.00, 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'pizza'),
('BBQ Chicken Pizza', 'Smoky chicken, mozzarella & sauce', 230.00, 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400&h=300&fit=crop', 'pizza'),
('Veggie Delight Pizza', 'Fresh veggies with cheese', 210.00, 'https://plus.unsplash.com/premium_photo-1664472696633-4b0b41e95202?q=80&w=1076&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'pizza'),
('Paneer Tikka Pizza', 'Indian paneer spices & cheese', 240.00, 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&h=300&fit=crop', 'pizza'),
('Cheese Burger', 'Juicy and tasty', 210.00, 'https://images.unsplash.com/photo-1572802419224-296b0aeee0d9?q=80&w=1115&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'burger'),
('Chicken Burger', 'Crispy chicken inside', 225.00, 'https://images.unsplash.com/photo-1544120379-4428412e6568?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'burger'),
('Coca Cola', 'Refreshing drink', 50.00, 'https://plus.unsplash.com/premium_photo-1725075086083-89117890371d?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'drink'),
('Orange Juice', 'Fresh and healthy', 60.00, 'https://images.unsplash.com/photo-1689066117649-0ca9762fc92c?q=80&w=1112&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'drink'),
('French Fries', 'Crispy & salty', 80.00, 'https://plus.unsplash.com/premium_photo-1683657860399-60f51361c65a?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'snack'),
('Veg Sandwich', 'Light and tasty', 120.00, 'https://plus.unsplash.com/premium_photo-1664472757995-3260cd26e477?q=80&w=1961&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'snack'),
('White Sauce Pasta', 'Creamy Italian pasta', 240.00, 'https://plus.unsplash.com/premium_photo-1664472619078-9db415ebef44?q=80&w=1076&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'snack'),
('Noodles', 'Spicy and delicious', 200.00, 'https://images.unsplash.com/photo-1616299806579-c2e2c4ee8e57?q=80&w=1043&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'snack'),
('Milkshake', 'Sweet and creamy', 90.00, 'https://plus.unsplash.com/premium_photo-1695868328524-b463bf440ccd?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'drink'),
('Mojito', 'Refreshing mint cocktail', 120.00, 'https://images.unsplash.com/photo-1551538827-9c037cb4f32a?w=400&h=300&fit=crop', 'drink'),
('Boba Tea', 'Sweet bubble tea', 110.00, 'https://images.unsplash.com/photo-1734770580735-796a00e42cb2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'drink'),
('Vanilla Ice Cream', 'Classic vanilla flavor', 80.00, 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=400&h=300&fit=crop', 'dessert'),
('Chocolate Ice Cream', 'Rich chocolate delight', 90.00, 'https://images.unsplash.com/photo-1597648152428-f883fbc9c873?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'dessert'),
('Strawberry Ice Cream', 'Fresh strawberry flavor', 85.00, 'https://plus.unsplash.com/premium_photo-1664391698459-2281b443d16c?q=80&w=1963&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'dessert'),
('Mango Ice Cream', 'Tropical mango taste', 95.00, 'https://images.unsplash.com/photo-1595275320712-24b6f2b0a984?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'dessert'),
('Dosa', 'Crispy South Indian crepe', 150.00, 'https://images.unsplash.com/photo-1668236543090-82eba5ee5976?w=400&h=300&fit=crop', 'indian'),
('Chole Bhature', 'Spicy chickpea curry with fried bread', 180.00, 'https://media.istockphoto.com/id/979914742/photo/chole-bhature-or-chick-pea-curry-and-fried-puri-served-in-terracotta-crockery-over-white.jpg?s=1024x1024&w=is&k=20&c=lKc3ytQPxxWtop4r7mgg6aNV_Z1Oe_2pAJYuXhTfhgE=', 'indian'),
('Biryani', 'Fragrant spiced rice dish', 220.00, 'https://images.unsplash.com/photo-1563379091339-03246963d96c?w=400&h=300&fit=crop', 'indian'),
('Butter Chicken', 'Creamy tomato curry with chicken', 250.00, 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae391?w=400&h=300&fit=crop', 'indian'),
('Rajma', 'Kidney bean curry', 160.00, 'https://images.unsplash.com/photo-1668236534990-73c4ed23043c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'indian'),
('Samosa', 'Crispy fried pastry with filling', 40.00, 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=400&h=300&fit=crop', 'indian'),
('Pakora', 'Deep-fried vegetable fritters', 50.00, 'https://images.unsplash.com/photo-1639024471283-03518883512d?w=400&h=300&fit=crop', 'indian'),
('Spaghetti Carbonara', 'Creamy bacon pasta', 240.00, 'https://images.unsplash.com/photo-1551892376-c73ba35588c7?w=400&h=300&fit=crop', 'pasta'),
('Penne Arrabbiata', 'Spicy tomato pasta', 220.00, 'https://images.unsplash.com/photo-1551892376-c73ba35588c7?w=400&h=300&fit=crop', 'pasta'),
('Fettuccine Alfredo', 'Creamy parmesan pasta', 230.00, 'https://images.unsplash.com/photo-1551892376-c73ba35588c7?w=400&h=300&fit=crop', 'pasta'),
('Pesto Pasta', 'Basil pesto with pasta', 210.00, 'https://images.unsplash.com/photo-1551892376-c73ba35588c7?w=400&h=300&fit=crop', 'pasta'),
('Gulab Jamun', 'Sweet milk dumplings in rose syrup', 80.00, 'https://images.unsplash.com/photo-1666190092159-3171cf0fbb12?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'dessert'),
('Rasgulla', 'Spongy cheese dumplings in syrup', 90.00, 'https://images.unsplash.com/photo-1714799263412-2e0c1f875959?q=80&w=1130&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'dessert');