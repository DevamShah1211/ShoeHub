<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoe_world";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, price, image_url FROM products LIMIT 3";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeHub - Home</title>
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

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>Step into Style</h1>
                    <p>Discover our collection of premium footwear for every occasion.</p>
                    <a href="products.php" class="btn btn-primary">Shop Now</a>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" class="img-fluid rounded-3" alt="Featured Shoe">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="container">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="product-card">
                    <img src="<?php echo $row['image_url']; ?>" class="product-image" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="price mb-3">RS <?php echo number_format($row['price'], 2); ?></p>
                            <a href="products.php" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
$conn->close();
?>