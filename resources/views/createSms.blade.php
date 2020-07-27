
@extends('layouts.app')

@section('content')
<div class="container">
<h1>Create your message.</h1>
    {!! Form::open(['action' => 'smssController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{@csrf_field()}}
                {{Form::label('phoneNumber', 'Destination Telephone Number:')}}
                {{Form::text('phoneNumber','',['class' => 'form-control', 'placeholder' => 'Please enter a valid UK telephone number',
                'pattern' => '^(?:0|\+?44)(?:\d\s?){9,10}$'])}}
        </div>
        <div class="form-group">
            {{@csrf_field()}}
                {{Form::label('message', 'Enter the message you wish to send. (Max 140 characters)')}}
                {{Form::textarea('message','',['class' => 'form-control', 'placeholder' => 'Message', 'maxLength' => '140'])}}
        </div>
        {{Form::submit('Send', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
</div>
@endsection
