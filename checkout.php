<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shoe_world");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardName = $_POST['cardName'];
    $cardNumber = $_POST['cardNumber'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    $subtotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = 5.00;
    $total = $subtotal + $shipping;
    
    $shippingFee = 5.00; 
    
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, address, city, state, zip, card_name, card_number, expiry, cvv, subtotal, shipping, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssddd", $firstName, $lastName, $email, $address, $city, $state, $zip, $cardName, $cardNumber, $expiry, $cvv, $subtotal, $shippingFee, $total);
    $stmt->execute();
    $orderID = $stmt->insert_id;
    
    foreach ($_SESSION['cart'] as $item) {
        $productName = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $itemSubtotal = $price * $quantity;
    
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isidd", $orderID, $productName, $quantity, $price, $itemSubtotal);
        $stmt->execute();
    }
    

    unset($_SESSION['cart']);
    header("Location: confirmation.php?order_id=" . $orderID);
    exit();
}
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
        <h1 class="text-center mb-4">Checkout</h1>
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-8">
                    <div class="card p-4">
                        <h5>Shipping Information</h5>
                        <div class="mb-3"><label class="form-label">First Name</label><input type="text" name="firstName" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Last Name</label><input type="text" name="lastName" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Address</label><input type="text" name="address" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">City</label><input type="text" name="city" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">State</label><input type="text" name="state" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">ZIP Code</label><input type="text" name="zip" class="form-control" required></div>
                        <h5>Payment Information</h5>
                        <div class="mb-3"><label class="form-label">Name on Card</label><input type="text" name="cardName" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Card Number</label><input type="text" name="cardNumber" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Expiry Date</label><input type="text" name="expiry" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">CVV</label><input type="text" name="cvv" class="form-control" required></div>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5>Order Summary</h5>
                        <ul class="list-group">
                            <?php
                            $total = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                    echo "<li class='list-group-item d-flex justify-content-between'>" . htmlspecialchars($item['name']) . " x " . $item['quantity'] . " <span>RS " . number_format($subtotal, 2) . "</span></li>";
                                }
                            } else {
                                echo "<li class='list-group-item text-center text-muted'>Your cart is empty</li>";
                            }
                            ?>
                        </ul>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Subtotal:</span>
                            <span>RS <?php echo number_format($total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Shipping:</span>
                            <span>RS 5.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong>RS <?php echo number_format($total + 5, 2); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
            <p>&copy; 2025 ShoeHub. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</body>
</html>
