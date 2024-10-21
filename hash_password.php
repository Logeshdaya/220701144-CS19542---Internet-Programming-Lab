<?php
// The password you want to hash
$password = "password123"; // Change this to the password you want to hash

// Hash the password using password_hash()
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo "Hashed Password: " . $hashed_password;
?>
