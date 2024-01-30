<?php
// Include database connection
require_once "db_connection.php";

// Retrieve posts from database
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

// Check if there are any posts
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . $row["author_name"] . "</h3>";
        echo "<p>" . $row["message"] . "</p>";
        // Output photo if available
        if (!empty($row["photo"])) {
            echo "<img src='uploads/" . $row["photo"] . "' alt='Post Photo'>";
        }
        echo "</div>";
    }
} else {
    echo "No posts available";
}
?>
