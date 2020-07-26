
@extends('layouts.app')

@section('content')
<h1>Create your message.</h1>
{!! Form::open(['action' => 'smssController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{@csrf_field()}}
            {{Form::label('phoneNumber', 'Destination Telephone Number:')}}
            {{Form::text('phoneNumber','',['class' => 'form-control', 'placeholder' => 'Phone Number',
            'pattern' => '^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$'])}}
    </div>
    <div class="form-group">
        {{@csrf_field()}}
            {{Form::label('message', 'Enter the message you wish to send. (Max 140 characters)')}}
            {{Form::textarea('message','',['class' => 'form-control', 'placeholder' => 'Message', 'maxLength' => '140'])}}
    </div>
    {{Form::submit('Send', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection

{{--
<div>
<input class="btn btn-primary" type="submit" value="Submit">
<br><br>
<input type="reset" class="btn btn-danger">
</div>
--}}
