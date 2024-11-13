<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    if (empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['subject']) OR empty($_POST['message'])) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    $to = 'wuorbhang@gmail.com';
    $from = 'from'.$email;
    $subject = '$subject'.$subject;
    $body = 'Name: '.$name. '\n Email: '.$email. '\n $Subject: '.$subject. '\n $Message: '.$message;

    mail($to, $from, $body);

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
