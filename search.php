<?php
// Database credentials
$servername = "localhost"; // Change if necessary
$db_username = "root"; // Your database username
$db_password = ""; // Your database password
$dbname = "plant_care"; // Your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$search_query = isset($_GET['q']) ? $_GET['q'] : '';

if ($search_query) {
    // Prepare and bind
    $stmt = $conn->prepare("SELECT name, description, image FROM plants WHERE name LIKE ?");
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any results were returned
    if ($result->num_rows > 0) {
        echo "<h2>Search Results for: " . htmlspecialchars($search_query) . "</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width:200px;height:auto;'>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No results found for \"" . htmlspecialchars($search_query) . "\".</p>";
    }

    $stmt->close();
} else {
    echo "<p>Please enter a search term.</p>";
}

$conn->close();
?>

<!-- Back to Home link -->
<div>
    <a href="pro.html" style="text-decoration: none; color: #007bff;">&larr; Back to Home</a>
</div>
