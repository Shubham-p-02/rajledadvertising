<?php
// Simple PHP contact form handler
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
        exit;
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
        exit;
    }
    
    // Prepare email content
    $to = "rajivsarsande@gmail.com";
    $email_subject = "Contact Form: $subject";
    
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Try to send email
    $mail_sent = mail($to, $email_subject, $email_body, $headers);
    
    if ($mail_sent) {
        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
    } else {
        // Fallback: Save to file if mail fails
        $log_file = 'contact_log.txt';
        $log_entry = date('Y-m-d H:i:s') . " - From: $name ($email) - Subject: $subject - Message: $message\n";
        
        if (file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX)) {
            echo json_encode(['status' => 'success', 'message' => 'Your message has been received. We will get back to you soon!']);
        } else {
            // Log error for debugging
            error_log("Failed to send email from contact form. To: $to, From: $email");
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email. Please contact us directly at rajivsarsande@gmail.com']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?> 