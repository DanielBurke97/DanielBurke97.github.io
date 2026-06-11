<?php
// Include database connection
require_once "db_connection.php";

// Retrieve posts from database
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Check if there are any posts
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . htmlspecialchars($row["author_name"]) . "</h3>";
        echo "<p><small>Posted: " . date('F j, Y', strtotime($row["created_at"])) . "</small></p>";
        echo "<p>" . nl2br(htmlspecialchars($row["message"])) . "</p>";
        if (!empty($row["photo"])) {
            echo "<img src='uploads/" . htmlspecialchars($row["photo"]) . "' alt='Memory Photo' style='max-width: 100%; border-radius: 5px; margin-top: 10px;'>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No memories shared yet. Be the first to share a memory of Daniel.</p>";
}

$conn->close();
?>
