<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Sms;
//Use Redis for queue and rate limiting
use Illuminate\Support\Facades\Redis;
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


class smssController extends Controller implements ShouldQueue
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return message listing page
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
        $sid = config('app.twilio_sid');
        $token = ''; //Remember to enter Auth Token


        // Create an authenticated client for the Twilio API
        $client = new Client($sid, $token);

        // Use the Twilio REST API client to send a text message
        $m = $client->messages->create(
            $number, // the number you'd like to send the message to
            [ // the text will be sent from your Twilio number
            'from' => '+447588672907', // A Twilio phone number you purchased at twilio.com/console
            'body' => $message, // the body of the text message
            "statusCallback" => "http://b44c33c58cc7.ngrok.io/response/"//Needs to be set to publicly accessable server address
            ]
  );

        // Create Sms in database
        $user =auth()->user();
        $sms = new Sms;
        $sms->user_id = $user->id;
        $sms->sid = $m->sid;
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
    public function update(Request $request)
    {

        $this->validate ($request, [
            'SmsSid' => 'required',
            'SmsStatus' => 'required',
        ]);

        // Create Sms in database
         $sms = Sms::where('sid', $request->SmsSid)->first();
         $sms->status = $request->SmsStatus;
         $sms->save();

         return response('Status updated', 200);


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
