<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sms;
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


class smssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Returm message listing page
         $messages = Sms::orderBy('created_at', 'desc') ->paginate(10);
        return view ('messages')->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createSms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate ($request, [
            'phoneNumber' => 'required',
            'message' => 'required',
        ]);

        $number = $request->input('phoneNumber');
        $message = $request->input('message');
        $sid = getenv('TWILIO_ACCOUNT_SID');
        $token = '';


        // Create an authenticated client for the Twilio API
        $client = new Client($sid, $token);

        // Use the Twilio REST API client to send a text message
        $m = $client->messages->create(
            $number, // the number you'd like to send the message to
            [ // the text will be sent from your Twilio number
            'from' => '+447588672907', // A Twilio phone number you purchased at twilio.com/console
            'body' => $message, // the body of the text message
            "statusCallback" => "http://4f9022637a59.ngrok.io"
            ]
  );

        // Create Sms in database
        $sms = new Sms;
        $sms->user_id = '1';
        $sms->sid = '1';
        $sms->status = 'Sent to Twilio';
        $sms->destination= $request->input('phoneNumber');
        $sms->message = $request->input('message');
        $sms->save();

        return redirect('/sms')->with('success', 'Message Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show details of individual message
        $message = Sms::find($id);
        return view ('message')->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
