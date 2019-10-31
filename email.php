<?php

require 'vendor/autoload.php';

use SendGrid\Mail\Personalization;
use SendGrid\Mail\To;

// Load our `.env` variables
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Define the 
$email_addresses = [
    'second@recipient.com',
];

// Declare a new SendGrid Mail object
$email = new \SendGrid\Mail\Mail();

// 
$email->setFrom("your@email.com", "Your Name");
$email->setSubject("Sample email to Twilio");
$email->addTo("first@recipient.com", "First Recipient");

foreach ( $email_addresses as $email_address ) {

    $personalization = new Personalization();
    $personalization->addTo( new To( $email_address ) );

    $email->addPersonalization( $personalization );
}


$email->addContent("text/plain", "Sending bulk emails is easy with SendGrid");
$email->addContent("text/html", "Sending bulk emails is easy with SendGrid");

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    echo "email sent!\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}