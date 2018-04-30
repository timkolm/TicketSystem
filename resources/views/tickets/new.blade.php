@extends('tickets.app')

@section('title') New Ticket @endsection

@section('content')
  <div class="row">
      <div class="col-lg-12 col-xl-12">
      <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
      <h1>New Ticket</h1>
        @include('tickets._form')
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="/js/form.js"></script>
@endsection