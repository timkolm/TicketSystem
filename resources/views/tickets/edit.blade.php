@extends('tickets.app')

@section('title') Edit Ticket {{$ticket->subject}} @endsection

@section('content')
  <div class="row">
      <div class="col-lg-12 col-xl-12">
      <form action="{{ route('update', ['id' => $ticket->id]) }}" method="post" enctype="multipart/form-data">
      <h1>Edit Ticket "{{$ticket->subject}}"</h1>
        @include('tickets._form')
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="/js/form.js"></script>
@endsection