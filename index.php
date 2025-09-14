<?php
require_once 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $category = trim($_POST['category'] ?? '');
    

    $errors = [];
    if (empty($name)) $errors[] = "Product name is required";
    if (empty($price) || !is_numeric($price) || $price <= 0) $errors[] = "Valid price is required";
    if (empty($category)) $errors[] = "Category is required";
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, category) VALUES (?, ?, ?)");
            $stmt->execute([$name, (float)$price, $category]);
            $message = "<div class='alert alert-success'>Product added successfully!</div>";
        } catch (PDOException $e) {
            $message = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>" . implode("<br>", $errors) . "</div>";
    }
}

$filter_category = $_GET['category'] ?? '';


$sql = "SELECT * FROM products";
$params = [];

if (!empty($filter_category)) {
    $sql .= " WHERE category = ?";
    $params[] = $filter_category;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();


$stmt = $pdo->prepare("SELECT DISTINCT category FROM products ORDER BY category");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-card {
            transition: transform 0.2s;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .price {
            color: #28a745;
            font-weight: bold;
            font-size: 1.2em;
        }
        .category-badge {
            background-color: #6c757d;
        }
        .form-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">🛍️ Product Catalog</h1>
            </div>
        </div>

        <!-- Add Product Form -->
        <div class="row mb-5">
            <div class="col-md-8 offset-md-2">
                <div class="form-section p-4">
                    <h3>Add New Product</h3>
                    <?php echo $message; ?>
                    
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Price ($) *</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label">Category *</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Books">Books</option>
                                <option value="Home">Home</option>
                                <option value="Sports">Sports</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <form method="GET" class="d-flex">
                    <select name="category" class="form-select me-2">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>" 
                                    <?php echo ($filter_category === $cat) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </form>
            </div>
            <div class="col-md-8">
                <?php if (!empty($filter_category)): ?>
                    <div class="d-flex align-items-center">
                        <span class="me-2">Filtered by: <strong><?php echo htmlspecialchars($filter_category); ?></strong></span>
                        <a href="index.php" class="btn btn-sm btn-outline-secondary">Clear Filter</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            <div class="col-12">
                <h3>Products (<?php echo count($products); ?> items)</h3>
            </div>
        </div>

        <div class="row">
            <?php if (empty($products)): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No products found. <?php echo !empty($filter_category) ? 'Try a different category or ' : ''; ?>Add some products using the form above!
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                                <span class="badge category-badge"><?php echo htmlspecialchars($product['category']); ?></span>
                                <div class="mt-3">
                                    <small class="text-muted">Added: <?php echo date('M j, Y', strtotime($product['created_at'])); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>