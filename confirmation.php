<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shoe_world");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order ID is provided
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid Order ID");
}

$orderID = intval($_GET['order_id']);

// Fetch order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderItems = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeHub - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">ShoeHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container my-5">
        <h1 class="text-center text-success">Order Confirmed!</h1>
        <p class="text-center">Thank you for your purchase, <strong><?php echo htmlspecialchars($order['first_name'] . " " . $order['last_name']); ?></strong>!</p>
        
        <div class="card p-4">
            <h5>Order Details</h5>
            <p><strong>Order ID:</strong> <?php echo $orderID; ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
            <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($order['address'] . ", " . $order['city'] . ", " . $order['state'] . " - " . $order['zip']); ?></p>

            <h5 class="mt-4">Items Ordered</h5>
            <ul class="list-group">
                <?php while ($item = $orderItems->fetch_assoc()) : ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <?php echo htmlspecialchars($item['product_name']); ?> x <?php echo $item['quantity']; ?>
                        <span>RS <?php echo number_format($item['subtotal'], 2); ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>

            <hr>
            <div class="d-flex justify-content-between">
                <span><strong>Subtotal:</strong></span>
                <span>RS <?php echo number_format($order['subtotal'], 2); ?></span>
            </div>
            <div class="d-flex justify-content-between">
                <span><strong>Shipping:</strong></span>
                <span>RS <?php echo number_format($order['shipping'], 2); ?></span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total:</strong>
                <strong>RS <?php echo number_format($order['total'], 2); ?></strong>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
    <!--Footer-->
    <footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h5>ShoeHub</h5>
                <p>Your one-stop destination for premium footwear.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="cart.php" class="text-white text-decoration-none">Cart</a></li>
                    <li><a href="about.html" class="text-white text-decoration-none">About Us</a></li>
                    <li><a href="contact.php" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="products.php" class="text-white text-decoration-none">Products</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#" class="mx-2"><i class="fa-brands fa-facebook fa-2x" style="color: white !important;"></i></a>
                <a href="#" class="mx-2"><i class="fa-brands fa-twitter fa-2x" style="color: white !important;"></i></a>
                <a href="#" class="mx-2"><i class="fa-brands fa-instagram fa-2x" style="color: white !important;"></i></a>
                <a href="#" class="mx-2"><i class="fa-brands fa-linkedin fa-2x" style="color: white !important;"></i></a>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center mt-3">
            <p>&copy; 2024 ShoeHub. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>
</html>
