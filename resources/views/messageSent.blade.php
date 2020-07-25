@extends('layouts.app')

@section('content')
<div class="title m-b-md text-center">
    <h1>Welcome to the Twilio message sending interface</h1>
</div>  
<div class="container-fluid ">
   <h2> Congratulations the message has been sent via Twilio</h2>
    <p><strong>You sent the following message:-</strong></p>
    <br><br>
    <p>{{$message}}</p>
    <br><br>
    <p><strong>To the following number:-</strong></p>
    <br><br>
    <p>{{$number}}</p>
</div>
@endsection