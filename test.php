<?php
// Simple test file to check if PHP is working
echo "<h1>PHP Test Page</h1>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Current Time:</strong> " . date('Y-m-d H:i:s') . "</p>";

// Test database connection
try {
    $pdo = new PDO("mysql:host=localhost;port=3307", 'root', '');
    echo "<p style='color: green;'><strong>✅ MySQL Connection:</strong> Success! (Port 3307)</p>";
    
    // Try to create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS product_catalog");
    echo "<p style='color: green;'><strong>✅ Database Creation:</strong> Success!</p>";
    
    // Connect to the database
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=product_catalog", 'root', '');
    echo "<p style='color: green;'><strong>✅ Database Connection:</strong> Success!</p>";
    
    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        category VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "<p style='color: green;'><strong>✅ Table Creation:</strong> Success!</p>";
    
    // Insert sample data
    $stmt = $pdo->prepare("INSERT IGNORE INTO products (id, name, price, category) VALUES (?, ?, ?, ?)");
    $products = [
        [1, 'iPhone 15 Pro', 999.99, 'Electronics'],
        [2, 'Samsung Galaxy Book', 899.99, 'Electronics'],
        [3, 'Nike Air Max 270', 149.99, 'Footwear'],
        [4, 'Adidas Ultraboost 22', 179.99, 'Footwear'],
        [5, 'Levi\'s 501 Jeans', 59.99, 'Clothing']
    ];
    
    foreach ($products as $product) {
        $stmt->execute($product);
    }
    
    echo "<p style='color: green;'><strong>✅ Sample Data:</strong> Inserted!</p>";
    echo "<p style='color: blue;'><strong>🎉 Everything is working!</strong></p>";
    echo "<p><a href='index.php' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Product Catalog</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><strong>❌ Database Error:</strong> " . $e->getMessage() . "</p>";
}
?>

<style>
body { 
    font-family: Arial, sans-serif; 
    max-width: 800px; 
    margin: 50px auto; 
    padding: 20px;
    background: #f5f5f5;
}
h1 { color: #333; }
p { 
    background: white; 
    padding: 10px; 
    margin: 10px 0; 
    border-radius: 5px;
    border-left: 4px solid #007cba;
}
</style>