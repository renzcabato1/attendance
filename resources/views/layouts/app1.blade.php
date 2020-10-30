<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8" />
    <link href="" rel="stylesheet'"/>
    <link rel="stylesheet" href="{{ asset('/chosen/docsupport/style.css')}}">
    <link rel="stylesheet" href="{{ asset('/chosen/docsupport/prism.css')}}">
    <link rel="stylesheet" href="{{ asset('/chosen/chosen.css')}}">
    <link rel="icon" type="image/png" href="{{ asset('/login_css/images/icons/logo.ico')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/login_css/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="{{ asset('/login_css/assets/css/animate.min.css')}}" rel="stylesheet'"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('/login_css/assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('/login_css/assets/css/demo.css')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="{{ asset('/login_css/assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link href="{{ asset('/login_css/style.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('/login_css/jquery-2.1.1.min.js')}}"></script>
    <script src="{{ asset('/login_css/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('jquery.min.js')}}"></script>
    <style>
        .content input[type="search"] {
            width:300px;
        }      
        .dataTables_filter {
            float: right;
        }
        .pagination
        {
            float: right;
        }
        .orange{
            background-color: orange;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            color:black;
            border:black;
        }
        .red{
            background-color: red;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            border:black;
        }
        .green{
            background-color: green;
            padding-left:7px;
            padding-right:7px;
            border-radius: 7px;
            border:black;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        body.modal-open div.modal-backdrop { 
            display:none; 
        }
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
    <style>
        .table-scroll {
            position:relative;
            margin:auto;
            overflow:hidden;
        }
        .table-wrap {
            width:100%;
            overflow:auto;
        }
        .table-scroll table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll th, .table-scroll td {
            padding:5px 10px;
            background:#fff;
            white-space:nowrap;
            vertical-align:top;
        }
        .table-scroll thead, .table-scroll tfoot {
            background:#f9f9f9;
        }
        .clone {
            position:absolute;
            top:0;
            left:0;
        }
        .clone th, .clone td {
            visibility:hidden
        }
        .clone td, .clone th {
            border-color:transparent
        }
        .clone tbody th {
            visibility:visible;
            color:red;
        }
        .clone .fixed-side {
            visibility:visible;
        }
        .clone thead, .clone tfoot{background:transparent;}
    </style>
    
</head>
<body>
    @yield('content')
    <script src="{{ asset('/chosen/docsupport/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/chosen/chosen.jquery.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/chosen/docsupport/prism.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('/chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script>
</body>
</html>
