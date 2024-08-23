<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check that all fields are filled out correctly
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill out all fields correctly.";
        exit;
    }

    // Specify the recipient (your email)
    $recipient = "petrova.olena.anatoliivna@gmail.com";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "An error occurred while sending your message.";
    }

} else {
    http_response_code(403);
    echo "Please submit the form correctly.";
}
?>