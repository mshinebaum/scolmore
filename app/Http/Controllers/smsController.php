<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

class smsController extends Controller
{
    //
    function sendSMS(Request $req)
    {
        $number = $req->input('phoneNumber');
        $message = $req->input('message');
        $sid = getenv('TWILIO_ACCOUNT_SID');
        $token = getenv('TWILIO_AUTH_TOKEN');


        // Create an authenticated client for the Twilio API
        $client = new Client($sid, $token);

        // Use the Twilio REST API client to send a text message
        $m = $client->messages->create(
            $number, // the number you'd like to send the message to
            [ // the text will be sent from your Twilio number
            'from' => '+447588672907', // A Twilio phone number you purchased at twilio.com/console
            'body' => $message // the body of the text message
            ]
  );

  // Return the message object to the browser as JSON
    $data = array(
        "number" => $number,
        "message" => $message
    );
  return view('messageSent', $data);
    }
}
