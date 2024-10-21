<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "plant_care"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?,?)");
$stmt->bind_param("ss", $username, $hashed_password);

// Set parameters and execute
$username = $_POST['username'];

$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
<div>
    <a href="pro.html" style="text-decoration: none; color: #007bff;">&larr; Back to Home</a>
</div>