<?php
// Database configuration
$servername = "localhost";
$username = "mysql.infoschema";
$password = "Daniel06122015!";
$dbname = "memories";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
