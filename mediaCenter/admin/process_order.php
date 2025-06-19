<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$quantity = $_POST['quantity'];
$pricePerUnit = $_POST['pricePerUnit'];
$shippingRate = $_POST['shippingRate'];
$price = $pricePerUnit * $quantity;
$shippingFee = $shippingRate * $quantity;
$totalPrice = $price + $shippingFee;

// Insert order into database
$sql = "INSERT INTO orders (product_name, quantity, price, shipping_fee, total_price, name, email, address, phone) VALUES ('Shea Butter', ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("idddssss", $quantity, $price, $shippingFee, $totalPrice, $name, $email, $address, $phone);

if ($stmt->execute()) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
