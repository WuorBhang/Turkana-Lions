<?php

// Replace with your real receiving email address
$receiving_email_address = 'uhuribhang21@gmail.com';

// Check if the PHP email form library exists and include it
if (file_exists($php_email_form = '../js/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance of the PHP_Email_Form class
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Validate and sanitize POST data
if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    // Sanitize input to prevent security risks (XSS, etc.)
    $contact->from_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $contact->message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Check if the email address is valid
    if (!filter_var($contact->from_email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address. Please check and try again.';
        exit;
    }

    // Assign recipient email address
    $contact->to = $receiving_email_address;

    // Add form messages
    $contact->add_message($contact->from_name, 'From');
    $contact->add_message($contact->from_email, 'Email');
    $contact->add_message($contact->message, 'Message', 10);

    // Send the email and echo the response
    echo $contact->send();
} else {
    echo 'Please complete all fields.';
}

?>
