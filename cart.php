<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shoe_world");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default image path
$defaultImage = "images/default.jpg";

// Function to check if an image file exists with any extension
function getValidImagePath($imageUrl)
{
    if (empty($imageUrl)) {
        return "images/default.jpg"; 
    }

    // Check if the path is already a valid image file
    if (file_exists($imageUrl)) {
        return $imageUrl;
    } elseif (file_exists("images/" . $imageUrl)) {
        return "images/" . $imageUrl;
    }

    return "images/default.jpg";
}

// Handle adding to cart
if (isset($_GET['add_to_cart']) && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $imagePath = getValidImagePath($product['image_url']);

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $imagePath 
            ];
        }
    }
    header("Location: cart.php");
    exit();
}

// Handle increment, decrement, and remove actions
if (isset($_POST['action'])) {
    $product_id = $_POST['product_id'];

    if ($_POST['action'] == 'increment') {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } elseif ($_POST['action'] == 'decrement') {
        if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['cart'][$product_id]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    } elseif ($_POST['action'] == 'remove') {
        unset($_SESSION['cart'][$product_id]);
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeHub - Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
        <h1 class="text-center mb-4">Shopping Cart</h1>
        <div class="table-responsive">
            <table class="table table-hover align-middle border shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        $imagePath = getValidImagePath($item['image']);

        echo "<tr>
            <td><img src='" . htmlspecialchars($imagePath) . "' class='img-fluid rounded' style='width: 60px; height: 60px; object-fit: cover;'></td>
            <td>" . htmlspecialchars($item['name']) . "</td>
            <td>RS " . number_format($item['price'], 2) . "</td>
            <td>
                <form method='post' class='d-inline-block'>
                    <input type='hidden' name='product_id' value='$id'>
                    <button type='submit' name='action' value='decrement' class='btn btn-sm btn-outline-danger'>-</button>
                </form>
                <span class='mx-2 fw-bold'>" . htmlspecialchars($item['quantity']) . "</span>
                <form method='post' class='d-inline-block'>
                    <input type='hidden' name='product_id' value='$id'>
                    <button type='submit' name='action' value='increment' class='btn btn-sm btn-outline-success'>+</button>
                </form>
            </td>
            <td>RS " . number_format($subtotal, 2) . "</td>
            <td>
                <form method='post'>
                    <input type='hidden' name='product_id' value='$id'>
                    <button type='submit' name='action' value='remove' class='btn btn-sm btn-danger'>Remove</button>
                </form>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center text-muted'>Your cart is empty</td></tr>";
}
?>
</tbody>
            </table>
        </div>
        <div class="text-end">
            <h4 class="fw-bold">Total: RS <span id="cartTotal"><?php echo number_format($total, 2); ?></span></h4>
            <a href="checkout.php" class="btn btn-lg btn-primary">Proceed to Checkout</a>
        </div>
    </div>
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
