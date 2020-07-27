@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Selected Message</h1>

    @if($message)
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

            <tr>
                <td>{{$message->id}}</td>
                <td>{{$message->user_id}}</td>
                <td>{{$message->destination}}</td>
                <td>{{$message->message}}</td>
                <td>{{$message->status}}</td>
                <td>{{$message->created_at}}</td>
                <td>{{$message->updated_at}}</td>
            </tr>

        </tbody>
    </table>
    @else
      <p>No message Found</p>
    @endif
    <a href="/sms" class="btn btn-primary">Go Back</a>
</div>
@endsection
