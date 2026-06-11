<?php
// submit_post_simple.php - Minimal version
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: Memories.html");
    exit();
}

$name = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : '';
$message = isset($_POST["message"]) ? strip_tags(trim($_POST["message"])) : '';

if (empty($name) || empty($message)) {
    header("Location: Memories.html?status=error&msg=Name+and+message+are+required");
    exit();
}

// CHANGE THIS TO YOUR EMAIL
$to = "your-email@example.com";
$subject = "New Memory from $name";
$body = "Name: $name\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\r\n";
$headers .= "Reply-To: noreply@yourdomain.com\r\n";

if (mail($to, $subject, $body, $headers)) {
    header("Location: Memories.html?status=success");
} else {
    header("Location: Memories.html?status=error&msg=Mail+failed");
}
exit();
?>
