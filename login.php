<?php
// Database credentials
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "plant_care"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct
             echo "Login successful!";
            header("Location: pro.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
    
    $stmt->close();
}

$conn->close();
?>
<div>
    <a href="login.html" style="text-decoration: none; color: #007bff;">&larr; Back to Home</a>
</div>