<?php
require_once 'email_config.php';

// Load PHPMailer
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));
    
    // Handle photo upload
    $photo_path = "";
    $upload_success = false;
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['photo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $file_size = $_FILES['photo']['size'];
        
        if (in_array($ext, $allowed) && $file_size <= 5000000) { // 5MB limit
            // Create uploads directory if it doesn't exist
            $upload_dir = "uploads/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generate unique filename
            $new_filename = time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
            $destination = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $destination)) {
                $photo_path = $new_filename;
                $upload_success = true;
            }
        }
    }
    
    // Validate
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    if (empty($errors)) {
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = SMTP_AUTH;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port = SMTP_PORT;
            $mail->CharSet = 'UTF-8';
            
            // Recipients
            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress(MEMORY_TO_EMAIL, MEMORY_TO_NAME);
            
            // Content
            $mail->isHTML(false);
            $mail->Subject = "Memorial Website: New Memory Shared by $name";
            
            $email_body = "A new memory has been shared on the memorial website.\n\n";
            $email_body .= "Name: $name\n";
            $email_body .= "Message:\n$message\n\n";
            
            if ($photo_path) {
                $email_body .= "Photo uploaded: $photo_path\n";
                $email_body .= "The photo has been saved to: " . $_SERVER['HTTP_HOST'] . "/uploads/$photo_path\n\n";
            }
            
            $email_body .= "---\nTo view all memories, visit the Memories page on the website.\n";
            
            $mail->Body = $email_body;
            
            // Attach photo if uploaded successfully
            if ($photo_path && file_exists("uploads/$photo_path")) {
                $mail->addAttachment("uploads/$photo_path");
            }
            
            $mail->send();
            
            header("Location: Memories.html?status=success");
            exit();
            
        } catch (Exception $e) {
            error_log("Memory mail error: " . $mail->ErrorInfo);
            header("Location: Memories.html?status=error&msg=" . urlencode("Unable to submit memory. Please try again later."));
            exit();
        }
    } else {
        $error_string = implode(", ", $errors);
        header("Location: Memories.html?status=error&msg=" . urlencode($error_string));
        exit();
    }
} else {
    header("Location: Memories.html");
    exit();
}
?>
