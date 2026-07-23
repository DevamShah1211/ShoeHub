<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoe_world";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $size_available = $_POST['size_available'];
    $color = $_POST['color'];
    $gender = $_POST['gender'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $ratings = $_POST['ratings'];
    $reviews = $_POST['reviews'];
    
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    
    $sql = "INSERT INTO products (name, brand, description, material, size_available, color, gender, stock, price, ratings, reviews, image_url) 
            VALUES ('$name', '$brand', '$description', '$material', '$size_available', '$color', '$gender', '$stock', '$price', '$ratings', '$reviews', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "New product added successfully.";
        } else {
            echo "Product added but image upload failed.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Add Product</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="border p-4 shadow rounded">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Brand:</label>
            <input type="text" name="brand" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Material:</label>
            <input type="text" name="material" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sizes Available (comma-separated):</label>
            <input type="text" name="size_available" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Color:</label>
            <input type="text" name="color" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gender:</label>
            <select name="gender" class="form-control" required>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ratings (1.0 - 5.0):</label>
            <input type="number" step="0.1" name="ratings" class="form-control" min="1" max="5" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Reviews:</label>
            <input type="number" name="reviews" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="text-center">
            <input type="submit" value="Add Product" class="btn btn-primary">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
