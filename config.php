<?php
// Database configuration that works
$host = 'localhost';
$dbname = 'product_catalog';
$username = 'root';
$password = 'Sauravusessql2003$';

try {
    // Try different connection methods
    $dsn_options = [
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
        "mysql:host=$host;port=3307;dbname=$dbname;charset=utf8"
    ];
    
    $pdo = null;
    $connection_error = '';
    
    foreach ($dsn_options as $dsn) {
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            break; // Success - exit loop
        } catch (PDOException $e) {
            $connection_error = $e->getMessage();
            continue; // Try next option
        }
    }
    
    // If no connection worked, try to create database first
    if (!$pdo) {
        try {
            $pdo_temp = new PDO("mysql:host=$host;charset=utf8", $username, $password);
            $pdo_temp->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>