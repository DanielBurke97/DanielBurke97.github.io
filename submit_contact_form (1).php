<?php
require_once 'email_config.php';

// Load PHPMailer
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));
    
    // Validate input
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, send email via SMTP
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
            $mail->addAddress(CONTACT_TO_EMAIL, CONTACT_TO_NAME);
            $mail->addReplyTo($email, $name);
            
            // Content
            $mail->isHTML(false); // Set to false for plain text
            $mail->Subject = "Memorial Website Contact: Message from $name";
            
            $email_body = "You have received a new message from the memorial website.\n\n";
            $email_body .= "Name: $name\n";
            $email_body .= "Email: $email\n";
            $email_body .= "Message:\n$message\n\n";
            $email_body .= "---\nThis message was sent from the Contact form on the Daniel Burke Memorial Website.\n";
            
            $mail->Body = $email_body;
            
            $mail->send();
            
            // Also send a confirmation email to the user
            $user_mail = new PHPMailer(true);
            $user_mail->isSMTP();
            $user_mail->Host = SMTP_HOST;
            $user_mail->SMTPAuth = SMTP_AUTH;
            $user_mail->Username = SMTP_USERNAME;
            $user_mail->Password = SMTP_PASSWORD;
            $user_mail->SMTPSecure = SMTP_SECURE;
            $user_mail->Port = SMTP_PORT;
            $user_mail->CharSet = 'UTF-8';
            
            $user_mail->setFrom(FROM_EMAIL, FROM_NAME);
            $user_mail->addAddress($email, $name);
            $user_mail->Subject = "We received your message - Daniel Burke Memorial Website";
            $user_mail->Body = "Dear $name,\n\nThank you for contacting us. We have received your message and will respond as soon as possible.\n\nBest regards,\nThe Burke Family\n\n---\nThis is an automated confirmation. Please do not reply to this email.";
            
            $user_mail->send();
            
            header("Location: Contact.html?status=success");
            exit();
            
        } catch (Exception $e) {
            // Log error (you can check server error logs)
            error_log("Mail error: " . $mail->ErrorInfo);
            header("Location: Contact.html?status=error&msg=" . urlencode("Unable to send message. Please try again later."));
            exit();
        }
    } else {
        $error_string = implode(", ", $errors);
        header("Location: Contact.html?status=error&msg=" . urlencode($error_string));
        exit();
    }
} else {
    header("Location: Contact.html");
    exit();
}
?>
