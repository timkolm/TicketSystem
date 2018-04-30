@extends('tickets.app')

@section('title') New Ticket @endsection

@section('content')
  <div class="row">
      <div class="col-lg-12 col-xl-12">
      <div class="jumbotron">
        <h1 class="display-4">{{$ticket->subject}}</h1>
        <p class="lead">Status: {{$ticket->status}}</p>
        <hr class="my-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{$ticket->user}}</h5>
            <p class="card-text">{{$ticket->description}}</p>
          </div>
        </div>
        @if(count($comments) > 0)
          @foreach($comments as $comment)
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$comment->user}}</h5>
              <p class="card-text">{{$comment->body}}</p>
            </div>
          </div>
          @endforeach
        @endif
        @if(count($ticket->files) > 0)
          <hr class="my-4">
          <h5>Attachments:</h5>
          <div>
            @foreach($ticket->files as $file)
              <span class="badge badge-pill badge-info">{{ $file->filename_old }}</span>
            @endforeach
          </div>
        @endif
        @if($ticket->status !== 'Closed')
        <hr class="my-4">
        <h5>Comment:</h5>
        <form action="{{route('commentCreate')}}" method="post">
          {{csrf_field()}}
          <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
          <div class="form-group">
            <label for="name">Your name:</label>
            <input type="text" class="form-control" name="user" required="required" value="{{ old('user') }}">
          </div>
          <div class="form-group">
            <label for="body">Comment here:</label>
            <textarea class="form-control" name="body" rows="3" required="required">{{ old('body') }}</textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Submit</button>
            <a href="{{route('index')}}" class="btn btn-default">Back</a>
          </div>
        </form>

          <div class="form-group" style="margin-top: 50px">
            <a href="{{ route('close', ['id'=>$ticket->id]) }}" class="btn btn-warning">Close</a>
          </div>
        @else
          <div class="form-group" style="margin-top: 50px">
            <a href="{{ route('reopen', ['id'=>$ticket->id]) }}" class="btn btn-success">Reopen</a>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection