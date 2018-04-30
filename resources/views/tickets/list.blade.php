@extends('tickets.app')

@section('title') Ticket List @endsection

@section('content')
  <div class="row">
    <h1>Tickets</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Opened <span><a href="{{route('index', ['sortBy'=>'created_at-asc'])}}">&uArr;</a></span> <span><a href="{{route('index', ['sortBy'=>'created_at-desc'])}}">&dArr;</a></span></th>
          <th>Subject <span><a href="{{route('index', ['sortBy'=>'subject-asc'])}}">&uArr;</a></span> <span><a href="{{route('index', ['sortBy'=>'subject-desc'])}}">&dArr;</a></span></th>
          <th>Status <span><a href="{{route('index', ['sortBy'=>'status-asc'])}}">&uArr;</a></span> <span><a href="{{route('index', ['sortBy'=>'status-desc'])}}">&dArr;</a></span></th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tickets as $ticket)
        <tr class="table-{{ $colors[$ticket->status] }}">
          <td>{{ $ticket->created_at }}</td>
          <td><a href="{{route('show', ['id'=>$ticket->id])}}">{{ $ticket->subject }}</a></td>
          <td>{{ $ticket->status }}</td>
          <td>
            @if(count($ticket->comments) === 0)
            <a href="{{ route('edit', ['id'=>$ticket->id]) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
            <a href="{{ route('destroy', ['id'=>$ticket->id]) }}" class="btn btn-sm btn-danger">Delete</a>
            @if($ticket->status !== 'Closed')
            <a href="{{ route('close', ['id'=>$ticket->id]) }}" class="btn btn-sm btn-warning">Close</a>
            @endif
            @if($ticket->status === 'Closed')
            <a href="{{ route('reopen', ['id'=>$ticket->id]) }}" class="btn btn-sm btn-success">Reopen</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="row" style="margin-bottom: 50px">
    <div class="col-lg-12 text-center">
      {{ $tickets->links("pagination::bootstrap-4") }}
    </div>
  </div>
  <div class="row" style="margin-bottom: 50px">
    <a href="{{ route('create') }}" class="btn btn-lg btn-block btn-success">Start a New Ticket</a>
  </div>
@endsection