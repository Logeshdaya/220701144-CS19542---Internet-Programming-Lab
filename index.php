<?php
// Database connection
$servername = "localhost"; // Change if needed
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "courses_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch courses
$sql = "SELECT title, video_url, description FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Video Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .content-section {
            text-align: center; /* Center the text in this section */
            margin: 40px 0; /* Add some spacing */
        }

        h2 {
            color: #ff5722; /* Course title color */
            font-size: 2.5em; /* Course title size */
            margin: 20px 0; /* Space above and below */
        }

        .video-container {
            margin: 20px 0; /* Add spacing around the video */
        }

        video {
            max-width: 50%; /* Ensure it is responsive */
            height: auto; /* Maintain aspect ratio */
            border: 1px solid #ddd; /* Optional border */
        }

        .course {
            margin-bottom: 40px; /* Space between courses */
            background: #fff; /* Background for each course */
            padding: 20px; /* Padding for course content */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .course-title {
            font-size: 1.8em; /* Title size */
            margin: 10px 0; /* Space above and below title */
        }

        .course-description {
            font-size: 1em; /* Description size */
            color: #666; /* Description color */
        }
    </style>
</head>
<body>

<section class="content-section">
    <h2>Online Video Courses</h2>

    <?php
   if ($result->num_rows > 0) {
    // Output data for each course
    while($row = $result->fetch_assoc()) {
        echo '<div class="course">';
        echo '<div class="course-title">' . htmlspecialchars($row["title"]) . '</div>';
        echo '<div class="video-container">';
        echo '<video controls playsinline>'; // Added controls attribute
        echo '<source src="' . htmlspecialchars($row["video_url"]) . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
        echo '</div>';
        echo '<div class="course-description">' . htmlspecialchars($row["description"]) . '</div>';
        echo '</div>';
    }
} else {
    echo 'No courses found.';
}
    $conn->close();
    ?>
</section>

</body>
</html>
<div>
    <a href="pro.html" style="text-decoration: none; color: #007bff;">&larr; Back to Home</a>
</div>