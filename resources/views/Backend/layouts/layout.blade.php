<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta id="csrf_token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Student Management') }}</title>

      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{asset('public/assets/css/material-dashboard.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

      <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
      <script src="{{asset('public/assets/js/popper.min.js')}}"></script>
      <script src="{{asset('public/assets/js/bootstrap-material-design.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

  </head>
  <body>
    <div class="wrapper">
      @include('backend.layouts.inc.sidebar')
      <div class="main-panel">

        @include('backend.layouts.inc.adminnavbar')

        <div class="content">
          @yield('content')
        </div>
        @include('backend.layouts.inc.adminfooter')

      </div>
    </div>
    @yield('script')
    @stack('scripts')
  </body>

</html>
