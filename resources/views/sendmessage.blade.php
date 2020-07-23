@extends('layouts.app')

@section('content')
<div class="title m-b-md text-center">
    <h1>Welcome to the Twilio message sending interface</h1>
</div>  
<div class="container-fluid ">
    <form action="/action_page.php">
        <div class="form-group">
            <label for="phoneNumber">Destination Telephone Number:</label><br>
            <input type="tel" id="phoneNumber" name="phoneNumber"
            placeholder="Phone Number"
            pattern="^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$">
        </div>
        <div class="form-group">    
            <label for="message">Message Text:</label><br>
            <input type="text" id="message" name="message" 
            placeholder="Enter message text here. (Max. 140 characters)" 
            maxlength=140 size=50>
        </div>
        <div>
            <input class="btn btn-primary" type="submit" value="Submit">
            <br><br>
            <input type="reset" class="btn btn-danger">
        </div>
    </form>
</div>
@endsection