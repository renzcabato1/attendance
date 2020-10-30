<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/login_po/css/main.css')}}">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
        opacity: .8;
        background-size:200px 120px;
    }    
</style>
<body>
    
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    <div id="app">  
        
        @yield('content')
    </div>
    <script src="{{ asset('/login_po/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{ asset('/login_po/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('/login_po/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login_po/js/main.js')}}"></script>
    <script  type = "text/javascript">
        function show() {
            document.getElementById("myDiv").style.display="block";
        }
    </script>
</body>
</html>
