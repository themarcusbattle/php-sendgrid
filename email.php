<?php

require 'vendor/autoload.php';

// Load our `.env` variables
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Declare a new SendGrid Mail object
$email = new \SendGrid\Mail\Mail();

// Set the email parameters
$email->setFrom("your@email.com", "Your Name");
$email->setSubject("Sending with SendGrid is Fun");

$email->addTo("their@email.com", "Their Name");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent("text/html", "and easy to do anywhere, even with PHP");

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

// Send the email
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    echo "email sent!\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}