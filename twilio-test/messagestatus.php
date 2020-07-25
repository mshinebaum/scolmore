<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$sid    = getenv('TWILIO_ACCOUNT_SID');
$token  = getenv('TWILIO_AUTH_TOKEN');
$number = getenv('TWILIO_PHONE_NUMBER');
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("07795363291", // to
                           [
                               "body" => "I am a jim jam wearing sausage",
                               "from" => '+447588672907',
                               "statusCallback" => "https://postb.in/1595620446673-1985188904218"
                           ]
                  );

print($message->sid);
