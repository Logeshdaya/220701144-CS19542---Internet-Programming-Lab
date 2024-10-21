<?php
session_start();

// Database connection
$host = 'localhost'; // Your database host
$db = 'plant_care'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user); // Return user details as JSON
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}

$stmt->close();
$conn->close();
?>
