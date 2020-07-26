@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Messages</h1>

    @if(count($messages) > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Message ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Destination</th>
            <th scope="col">Message Body</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Last Updated</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($messages as $message)
            <tr>
            <td><a href="/sms/{{$message->id}}">{{$message->id}}</a></td>
                <td>{{$message->user_id}}</td>
                <td>{{$message->destination}}</td>
                <td>{{$message->message}}</td>
                <td>{{$message->status}}</td>
                <td>{{$message->created_at}}</td>
                <td>{{$message->updated_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$messages->links()}}
    @else
      <p>No messages Found</p>
    @endif
    <a href="/send-message" class="btn btn-primary">Send New Message</a>
</div>
@endsection
