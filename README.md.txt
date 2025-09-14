# Product Catalog PHP + MySQL Project

## Project Overview

This project consists of two main tasks:
1. **Task 1**: PHP + MySQL Backend Product Catalog
2. **Task 2**: Shopify/Liquid Frontend Simulation

## Features Implemented

### Task 1: PHP + MySQL Backend 
- Database table: products (id, name, price, category)
- Product listing with 8 sample entries
- Add new product form with validation
- Prepared statements for security
- **Bonus**: Category dropdown filter

### Task 2: Frontend Simulation 
- Featured product display with image, name, price, Buy Now button
- Responsive design (desktop & mobile)
- **Bonus**: Hover effects on product image
- Interactive animations and modern design

## File Structure

```
project/
├── config.php                     # Database configuration
├── index.php                      # Main product catalog page
├── featured-product-section.html  # Shopify/Liquid simulation
├── database_setup.sql             # Database schema
├── product_catalog_dump.sql       # Complete database dump
├── debug_connection.php           # Database troubleshooting
└── README.md                      # This file
```

## Local Setup Instructions

### Prerequisites
- XAMPP/WAMP/MAMP (Apache, PHP, MySQL)
- Web browser

### Installation Steps

1. **Install XAMPP**
   - Download from: https://www.apachefriends.org/
   - Install and start Apache + MySQL services

2. **Setup Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Import `product_catalog_dump.sql`
   - Or run the SQL commands manually

3. **Deploy Files**
   ```bash
   # Copy project to web directory
   cp -r project/ /path/to/xampp/htdocs/PRODUCT_CATALOG_PHP_SQL/
   ```

4. **Configure Database**
   - Update `config.php` with your MySQL credentials
   - Default XAMPP: username='root', password=''

5. **Test Application**
   - Backend: `http://localhost/PRODUCT_CATALOG_PHP_SQL/index.php`
   - Frontend: `http://localhost/PRODUCT_CATALOG_PHP_SQL/featured-product-section.html`

## Database Schema

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Technologies Used

### Backend
- PHP 7.4+
- MySQL 5.7+
- PDO for database connections
- Bootstrap 5 for styling

### Frontend
- HTML5
- CSS3 (Modern animations, gradients, glassmorphism)
- JavaScript (Interactive elements)
- Responsive design

## Features Demonstrated

### Security
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- XSS protection with htmlspecialchars()

### User Experience
- Responsive design for all screen sizes
- Form validation with error messages
- Category filtering
- Modern, interactive UI

### Database Operations
- CRUD operations (Create, Read)
- Dynamic filtering
- Prepared statements
- Error handling

## Browser Compatibility
- Chrome/Chromium
- Firefox
- Safari
- Edge
- Mobile browsers

## Contact
Project created for PHP + MySQL demonstration