<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('image/favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

    <!-- Scripts -->
	<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};



    function imprSelec(historial){
      var ficha=document.getElementById(historial);
      var ventimp=window.open(' ','popimpr');
      ventimp.document.write(ficha.innerHTML);
      ventimp.document.close();
      ventimp.print();
      ventimp.close();
    }

    </script>
    

<!--
  <style type="text/css">
    td {
      border: orange 5px solid;
    } 
-->    
  </style>



</head>
<body>
    
    <div id="app2">
        <nav class="navbar navbar-default navbar-static-top background-menu">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar" style="background-color:#ffffff"></span>
                        <span class="icon-bar" style="background-color:#ffffff"></span>
                        <span class="icon-bar" style="background-color:#ffffff"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img width="20px" height="20px" src="{{ asset('image/favicon.ico') }}">
                    </a>
                </div>
				

                
				<!-- Incluye Menú -->
				@include('layouts.menu')
                
            </div>
        </nav>


            @yield('content')            


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dropdown.js') }}"></script>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    @yield('scripts')

</body>
</html>
