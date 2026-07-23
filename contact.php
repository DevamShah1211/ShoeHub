<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoe_world";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$success = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $message);

            if ($stmt->execute()) {
                $success = "Message sent successfully!";
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Invalid email format!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeHub - Contact Us</title>
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

    <div class="container my-5 d-flex justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Contact Us</h1>
            <p class="lead text-center">We'd Love to Hear from You</p>
            
            <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
            <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form method="post" class="mt-4 p-4 border rounded shadow bg-light">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
            </form>
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

<?php
$conn->close();
?>
