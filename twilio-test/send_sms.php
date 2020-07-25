<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$account_sid = $_ENV["TWILIO_ACCOUNT_SID"];
$auth_token = $_ENV["TWILIO_AUTH_TOKEN"];
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

//Get args from script call
$phoneNumber = $_GET['phoneNumber'];
$message = $_GET['message'];

// A Twilio number you own with SMS capabilities
$twilio_number = "+447588672907";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    $phoneNumber,
    array(
        'from' => $twilio_number,
        'body' => $message
    )
);