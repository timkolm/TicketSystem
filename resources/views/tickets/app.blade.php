<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  </head>
  <body>
    <div class="content">
      @php
        if($errors->any()){
          $session = '<h3>Error!</h3><ul>';
            foreach ($errors->all() as $error){
              $session .= '<li>'. $error .'</li>';
            }
          $session .= '</ul>';
          Session::flash('danger', $session);
        }
        $notices = ['danger','success','warning','info'];
      @endphp
      @foreach($notices as $notice)
        @if(!empty(session($notice)))
        <div class="col-lg-8 col-xl-8 offset-lg-2 offset-xl-2" style="margin-top: 20px">
          <div class="alert alert-{{$notice}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>{!! session($notice) !!}</p>
          </div>
        </div>
        @php
          session()->forget($notice);
        @endphp
        @endif
      @endforeach
      <div class="col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        @yield('content')
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    @yield('scripts')
  </body>
</html>
